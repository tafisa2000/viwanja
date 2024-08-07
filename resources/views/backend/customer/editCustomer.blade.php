@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-body">

                            <h1 class="text-xl font-bold card-title">Edit Customer Page</h1>
                            @if (count($errors))
                                @foreach ($errors->all() as $error)
                                    <p class="alert alert-danger">{{ $error }}</p>
                                @endforeach
                            @endif
                            <form action="{{ route('update.customer') }}" enctype="multipart/form-data" method="post"
                                class="mt-4" id="myForm">
                                @csrf
                                <input class="d-none" name="id" type="text" value="{{ $customer->id }}">
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Name:</label>
                                    <div class="col-sm-8 form-group">
                                        <input class="form-control" type="text" name="name"
                                            value="{{ $customer->name }}" id="name">
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Mobile No.</label>
                                    <div class="col-sm-8 form-group">
                                        <input class="form-control" type="text" name="mobile_no"
                                            value="{{ $customer->mobile_no }}" id="mobile_no">
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Email</label>
                                    <div class=" form-group col-sm-8">
                                        <input class="form-control" type="email" name="email"
                                            value="{{ $customer->email }}" id="email">
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Address</label>
                                    <div class=" form-group col-sm-8">
                                        <input class="form-control" type="text" name="address"
                                            value="{{ $customer->address }}" id="address">
                                    </div>
                                </div>
                                <!-- end row -->
                                {{-- <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Image </label>
                                    <div class="col-sm-8 form-group">
                                        <input name="image" class="form-control" type="file" id="image">
                                    </div>
                                </div> --}}
                                <!-- end row -->
                                {{--
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label"> </label>
                                    <div class="col-sm-10">
                                        <img id="showImage" class="rounded avatar-lg"
                                            src="{{ !empty($customer->image) ? url($customer->image) : url('upload/no_image.jpg') }}"
                                            alt="Card image cap">
                                    </div>
                                </div> --}}


                                {{-- <div class="flex justify-end">
                                    <button type="submit"
                                        class="px-3 py-2 font-semibold text-white bg-blue-900 rounded-lg hover:bg-blue-800">Edit
                                        Customer</button>
                                </div> --}}

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-dark waves-effect waves-light">Edit
                                        Customer</button>
                                </div>
                                <!-- end row -->
                            </form>


                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    mobile_no: {
                        required: true,
                    },
                    email: {
                        required: true,
                    },
                    address: {
                        required: true,
                    },

                },
                messages: {
                    name: {
                        required: 'Please Enter Supplier name',
                    },
                    mobile_no: {
                        required: 'Please Enter Mobile number',
                    },
                    email: {
                        required: 'Please Enter Email',
                    },
                    address: {
                        required: 'Please Enter Address',
                    },

                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
