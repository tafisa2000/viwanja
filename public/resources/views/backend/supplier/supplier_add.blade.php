@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Add Suplier Page</h4><br><br>

                            <form method="POST" action="{{ route('supplier.store') }}" id="myForm">
                                @csrf
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Suplier Name</label>
                                    <div class="col-sm-10 form-group">
                                        <input class="form-control" name="name" type="text">
                                    </div>
                                </div>

                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label ">Suplier Mobile</label>
                                    <div class="col-sm-10 form-group">
                                        <input class="form-control" name="mobile_no" type="text">
                                    </div>
                                </div>

                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Suplier Email</label>
                                    <div class="col-sm-10 form-group">
                                        <input class="form-control" name="email" type="email">
                                    </div>
                                </div>

                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Suplier Address</label>
                                    <div class="col-sm-10 form-group">
                                        <input class="form-control" name="address" type="text">
                                    </div>
                                </div>

                                <!-- end row -->




                                <input type="submit" class="btn btn-info waves-effect waves-light" value="add suplier">
                            </form>
                            <!-- end row -->


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
                        required: 'Please Enter Suplier Name',
                    },
                    mobile_no: {
                        required: 'Please Enter Suplier Mobile number',
                    },
                    email: {
                        required: 'Please Enter Suplier Email',
                    },
                    address: {
                        required: 'Please Enter Suplier Address',
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
@endsection
