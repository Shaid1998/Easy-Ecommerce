@extends('admin.admin_master')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <img class="rounded-circle avatar-x1" src="{{ (!empty($adminData->profile_image))? url('upload/admin/'.$adminData->profile_image):url('upload/no_image.jpg') }}" alt="User Image">
                <div class="card-body">
                    <h4 class="card-title">Userame : {{ $adminData->username }}</h4>
                    <hr>
                    <h4 class="card-title">Name : {{ $adminData->name }}</h4>
                    <hr>
                    <h4 class="card-title">Email : {{ $adminData->email }}</h4>
                    <hr>
                    
                </div>
                <a herf="{{ route('edit.profile') }}" class="btn btn-info waves-effect waves-light" type="submit" > Edit Profile </a>
            </div>
        </div>
    </div>
</div>




@endsection