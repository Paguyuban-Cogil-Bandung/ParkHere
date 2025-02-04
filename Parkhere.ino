#include <ESP32Servo.h>
#include <WiFi.h>
#include <PubSubClient.h>
#include <ArduinoJson.h>

// Konfigurasi WiFi dan MQTT Broker
const char *ssid = "Bunvit Home";
const char *password = "02072215";
const char *mqtt_server = "mqtt.ourproject.my.id";
String mqttMessage = "";

WiFiClient espClient;
PubSubClient client(espClient);

// Konfigurasi IOT
Servo myservo2;
Servo myservo1;

int IR1 = 13;  // Sensor masuk terhubung ke IO12
int IR2 = 12;  // Sensor keluar terhubung ke IO13

int flag1 = 0;
int flag2 = 0;

// // Posisi servo untuk membuka dan menutup
int S2_BUKA = 0;     // Posisi servo saat membuka
int S2_TUTUP = 90;  // Posisi servo saat menutup

int S1_BUKA = 90;
int S1_TUTUP = 0;

// GPIO yang bisa digunakan untuk PWM di ESP32
int servoPin1 = 4;  // Servo 1 (IN) terhubung ke IO4
int servoPin2 = 2;  // Servo 2 (OUT) terhubung ke IO2

unsigned long timer1 = 0;                      // Timer untuk gate masuk
unsigned long timer2 = 0;                      // Timer untuk gate keluar
const unsigned long DELAY_TIME_MASUK = 5000;   // Jeda waktu 5 detik untuk gate masuk
const unsigned long DELAY_TIME_KELUAR = 5000;  // Jeda waktu 8 detik untuk gate keluar

// MQTT
void setup_mqtt() {
  client.setServer(mqtt_server, 1883);
  client.setCallback(callback);

  // Coba hubungkan dan berlangganan topic
  if (client.connect("ESP32Client")) {
    Serial.println("Connected to MQTT Broker!");
    client.subscribe("parking/action");
  } else {
    Serial.println("MQTT Connection Failed!");
  }
}

void reconnect() {
  while (!client.connected()) {
    Serial.println("Menghubungkan ke MQTT...");
    if (client.connect("ESP32_Client")) {
      Serial.println("Terhubung ke MQTT!");
    } else {
      Serial.print("Gagal, rc=");
      Serial.print(client.state());
      Serial.println(" Coba lagi dalam 5 detik...");
      delay(5000);
    }
  }
}

void execute_mqtt(String jsonMessage) {
  // Parse JSON
  StaticJsonDocument<200> doc;
  DeserializationError error = deserializeJson(doc, jsonMessage);

  if (error) {
    Serial.print("JSON Parsing failed: ");
    Serial.println(error.c_str());
    return;
  }

  // Ambil nilai dari JSON
  const char *type = doc["type"];
  Serial.print("Type: ");
  Serial.println(type);

  if (strcmp(type, "action") == 0) {
    const char *device = doc["device"];
    int state = doc["state"];

    Serial.print("Device: ");
    Serial.println(device);
    Serial.print("State: ");
    Serial.println(state);

    if (strcmp(device, "SRV1") == 0) {
      if (state == 0) {
        Serial.println("Menutup servo 1 (SRV1)...");
        myservo1.write(S1_TUTUP);
      } else if (state == 1) {
        Serial.println("Membuka servo 1 (SRV1)...");
        myservo1.write(S1_BUKA);
      }
    } else if (strcmp(device, "SRV2") == 0) {
      if (state == 0) {
        Serial.println("Menutup servo 2 (SRV2)...");
        myservo2.write(S2_TUTUP);
      } else if (state == 1) {
        Serial.println("Membuka servo 2 (SRV2)...");
        myservo2.write(S2_BUKA);
      }
    }
  }
}

// Callback function to handle incoming MQTT messages
void callback(char *topic, byte *message, unsigned int length) {
  Serial.print("Message received on topic: ");
  Serial.println(topic);

  mqttMessage = "";
  for (int i = 0; i < length; i++) {
    mqttMessage += (char)message[i];
  }

  execute_mqtt(mqttMessage);
}

void setup() {
  Serial.begin(115200);

  // setup 3rd party
  setup_wifi();
  setup_mqtt();

  pinMode(IR1, INPUT);
  pinMode(IR2, INPUT);

  // Attach servos ke pin dengan PWM
  myservo2.attach(servoPin1);
  myservo1.attach(servoPin2);

  // Set posisi awal servo
  myservo2.write(S2_TUTUP);  // Gate masuk tertutup
  myservo1.write(S1_TUTUP);  // Gate keluar tertutup

  Serial.println("     ESP32-CAM    ");
  Serial.println(" PARKING SYSTEM ");

  delay(2000);
}

void setup_wifi() {
  delay(1000);
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.print(".");
  }
  Serial.println("WiFi connected");
  Serial.println(WiFi.localIP());
}


void loop() {
  if (!client.connected()) {
    reconnect();
  }
  client.loop();

  // Deteksi mobil di pos masuk
  if (digitalRead(IR1) == LOW && flag1 == 0) {
    flag1 = 1;                // Set flag agar tidak berulang
    myservo2.write(S2_BUKA);  // Buka gate masuk (dibalik)
    timer1 = millis();        // Catat waktu saat gate dibuka
    Serial.println("Gate Masuk Dibuka");

    // Kirim ke MQTT
    int ir1_state = digitalRead(IR1);
    String payload = "{ \"type\": \"detect\", \"device\": \"IR1\", \"state\": " + String(ir1_state) + " }";
    Serial.print("Mengirim data: ");
    Serial.println(payload);
    client.publish("parking/detect", payload.c_str());
  }

  // Jika sudah melewati 5 detik sejak gate masuk dibuka
  if (flag1 == 1 && (millis() - timer1 >= DELAY_TIME_MASUK)) {
    if (digitalRead(IR1) == LOW) {
      // Jika masih terdeteksi maka tambahkan lagi delay
      timer1 = millis();
    } else {
      // Tutup jika sudah tidak terdeteksi
      flag1 = 0;                 // Reset flag
      myservo2.write(S2_TUTUP);  // Tutup gate masuk (dibalik)
      Serial.println("Gate Masuk Ditutup");

      // Kirim ke MQTT
      int ir1_state = digitalRead(IR1);
      String payload = "{ \"type\": \"detect\", \"device\": \"IR1\", \"state\": " + String(ir1_state) + " }";
      Serial.print("Mengirim data: ");
      Serial.println(payload);
      client.publish("parking/detect", payload.c_str());
    }
  }

  // Deteksi mobil di pos keluar
  if (digitalRead(IR2) == LOW && flag2 == 0) {
    flag2 = 1;                // Set flag agar tidak berulang
    myservo1.write(S1_BUKA);  // Buka gate keluar
    timer2 = millis();        // Catat waktu saat gate dibuka
    Serial.println("Gate Keluar Dibuka");

    // Kirim ke MQTT
    int ir2_state = digitalRead(IR2);
    String payload = "{ \"type\": \"detect\", \"device\": \"IR2\", \"state\": " + String(ir2_state) + " }";
    Serial.print("Mengirim data: ");
    Serial.println(payload);
    client.publish("parking/detect", payload.c_str());
  }

  // Jika sudah melewati 8 detik sejak gate keluar dibuka
  if (flag2 == 1 && (millis() - timer2 >= DELAY_TIME_KELUAR)) {
    if (digitalRead(IR2) == LOW) {
      // Jika masih terdeteksi maka tambahkan lagi delay
      timer2 = millis();
    } else {
      flag2 = 0;                 // Reset flag
      myservo1.write(S1_TUTUP);  // Tutup gate keluar
      Serial.println("Gate Keluar Ditutup");

      // Kirim ke MQTT
      int ir2_state = digitalRead(IR2);
      String payload = "{ \"type\": \"detect\", \"device\": \"IR2\", \"state\": " + String(ir2_state) + " }";
      Serial.print("Mengirim data: ");
      Serial.println(payload);
      client.publish("parking/detect", payload.c_str());
    }
  }

  delay(100);  // Delay ringan untuk menghindari pembacaan berulang yang terlalu cepat
}