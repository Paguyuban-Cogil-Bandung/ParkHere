@extends('layout.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('menu')
    @include('Admin.menu')
@endsection

@section('content')
    @include('layout.navbars.auth.topnav', ['title' => 'Tables'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Authors table</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table id="users" class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>User Type</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection

@section('js')
<script>
    new DataTable('#users', {
        ajax: 'https://parkhere-backend.ourproject.my.id/user/list',
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'email' },
            { data: 'usertype' },
            { data: 'created_at' },
            {
                data: null,
                className: "dt-center editor-delete",
                orderable: false,
                "mRender" : function ( data, type, row ) {
                    return `<a href="" id="updatetebtn_${data.id}" >Update <i class="fe fe-edit"></i></a> 
                    <a href="" id="deletebtn_${data.id}" >Delete <i class="fe fe-delete"></i></a>`;
                }
            },
            { data: 'updated_at', visible:false  },
            { data: 'password', visible:false },
        ],
        processing: true,
        serverSide: true,
        order: {},
    });
</script>
@endsection
