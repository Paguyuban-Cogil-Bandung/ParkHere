@extends('layout.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('menu')
    @include('Petugas.menu')
@endsection

@section('title')
    Edit Profile
@endsection

@section('content')
    @include('layout.navbars.auth.topnav', ['title' => 'Profile'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="justify-content-between">
                            <h6 class="pt-0">Update Informasi</h6>
                        </div>
                        <hr>
                    </div>
                    <div class="card-body pb-0">
                    <div class= "justify-content-between w-100">
                        <form method="post" action="{{ route('petugas.profile.update') }}">
                            @csrf
                            @method('put')
                        
                    <div class="row mb-3">
                        <label for="name" class="col-md-2 col-form-label text-md-start">Name</label>
                        <div class="col-md-9">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', auth()->user()->name) }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-md-2 col-form-label text-md-start">Password</label>
                        <div class="col-md-9">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-2">
                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                        </div>
                    </div>
                    </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class=" justify-content-between">
                            <h6 class="pt-0 text-danger">Hapus Akun</h6>
                        </div>
                        <hr>
                    </div>
                    <div class="card-body pb-0 pt-0 ">
                        <div class="justify-content-between">

                            <h6 class="text-sm">Apakah anda yakin ingin menghapus akun ini?</h6>
                            <form method="POST" action="{{ route('petugas.profile.destroy') }}">
                                @csrf
                                @method('delete')
                                <div class="row mb-0">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Ya, hapus Akun
                                        </button>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection

@section('js')

@endsection