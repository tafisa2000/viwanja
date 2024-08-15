@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Edit Project Page</h4><br><br>

                            <form method="POST" action="{{ route('project.update') }}" id="myForm">
                                @csrf

                                <input type="hidden" name="id" value="{{ $project->id }}">

                                <div class="row mb-3">
                                    <label for="name" class="col-sm-2 col-form-label">Project Name</label>
                                    <div class="col-sm-10 form-group">
                                        <input class="form-control" id="name" value="{{ $project->name }}"
                                            name="name" type="text" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="size" class="col-sm-2 col-form-label">Project Size in sqm</label>
                                    <div class="col-sm-10 form-group">
                                        <input class="form-control" id="size" value="{{ $project->size }}"
                                            name="size" type="number" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="cost" class="col-sm-2 col-form-label">Project Cost Tsh</label>
                                    <div class="col-sm-10 form-group">
                                        <input class="form-control input-mask" id="cost"
                                            data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': '', 'placeholder': '0'"
                                            value="{{ number_format($project->cost, 2) }}" name="cost" type="text"
                                            required>
                                    </div>
                                </div>

                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Project">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            // Initialize InputMask
            $('#cost').inputmask();

            $('#myForm').validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 255
                    },
                    size: {
                        required: true,
                        maxlength: 255
                    },
                    cost: {
                        required: true,
                        number: true
                    },
                },
                messages: {
                    name: {
                        required: 'Please enter the project name',
                        maxlength: 'The project name cannot be longer than 255 characters'
                    },
                    size: {
                        required: 'Please enter the project size',
                        maxlength: 'The project size cannot be longer than 255 characters'
                    },
                    cost: {
                        required: 'Please enter the project cost',
                        number: 'Please enter a valid number for the project cost'
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
