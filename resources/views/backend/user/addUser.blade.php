@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add User</h4>

                            <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="name" type="text" id="name"
                                            value="{{ old('name') }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="email" type="email" id="email"
                                            value="{{ old('email') }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="username" class="col-sm-2 col-form-label">User Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="username" type="text" id="username"
                                            value="{{ old('username') }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="profile_image" class="col-sm-2 col-form-label">Profile Image</label>
                                    <div class="col-sm-10">
                                        <input name="profile_image" class="form-control" type="file" id="image">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="role" class="col-sm-2 col-form-label">User Role</label>
                                    <div class="col-sm-10">
                                        <select name="role" id="role" class="form-select" required>
                                            <option value="" disabled selected>Select Role</option>
                                            <option value="admin">Admin</option>
                                            <option value="accountant">Accountant</option>
                                            <option value="reception">Reception</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="newpassword" class="col-sm-2 col-form-label">New Password</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="password" type="password" id="newpassword">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="confirmpassword" class="col-sm-2 col-form-label">Confirm Password</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="password_confirmation" type="password"
                                            id="confirmpassword">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-10 offset-sm-2">
                                        <img id="showImage" class="rounded avatar-lg" src="{{ url('upload/no_image.jpg') }}"
                                            alt="Profile Image">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-10 offset-sm-2">
                                        <input type="submit" class="btn btn-info waves-effect waves-light"
                                            value="Add User">
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>

    <script>
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        });
    </script>
@endsection
