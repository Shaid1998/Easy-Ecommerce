@extends('admin.admin_master')
@section('admin')


<div class="page-content">
    <div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Change Password Page </h4>
                    <form method="post" action="{{ route('store.profile') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Old Password</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="oldpassword" type="text"  id="example-text-input">
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">New Password</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="newpassword" type="text"  id="example-text-input">
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Confirm New Password</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="confirmnewpassword" type="text"  id="example-text-input">
                            </div>
                        </div>
                        <!-- end row -->
                        <input type="submit" class="btn btn-info waves-effect waves-light" value="Change Password">
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    </div>
</div>

@endsection