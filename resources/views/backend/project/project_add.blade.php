@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Add Project Page</h4><br><br>

                            <form method="POST" action="{{ route('project.store') }}" id="myForm">
                                @csrf
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-2 col-form-label">Project Name</label>
                                    <div class="col-sm-10 form-group">
                                        <input class="form-control" id="name" name="name" type="text" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="size" class="col-sm-2 col-form-label">Project Size in sqm</label>
                                    <div class="col-sm-10 form-group">
                                        <input class="form-control" id="size" name="size" type="number" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="cost" class="col-sm-2 col-form-label">Project Cost</label>
                                    <div class="col-sm-10 form-group">
                                        <input class="form-control input-mask" id="input-currency"
                                            data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': '', 'placeholder': '0'"
                                            placeholder="Enter Amount" name="cost" required>
                                    </div>
                                </div>

                                <!-- end row -->
                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Add Project">
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
            // Initialize InputMask
            $('#input-currency').inputmask();

            $('#myForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    size: {
                        required: true,
                    },
                    cost: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: 'Please enter the project name',
                    },
                    size: {
                        required: 'Please enter the project size',
                    },
                    cost: {
                        required: 'Please enter the project cost',
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
