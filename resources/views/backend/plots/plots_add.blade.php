@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add Plot</h4><br><br>

                            <form method="POST" action="{{ route('plot.store') }}" id="myForm">
                                @csrf
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-2 col-form-label">Plot Name</label>
                                    <div class="col-sm-10 form-group">
                                        <input class="form-control" id="name" name="name" type="text" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="size" class="col-sm-2 col-form-label">Plot Size</label>
                                    <div class="col-sm-10 form-group">
                                        <input class="form-control" id="size" name="size" type="text" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="form-group col-md-9">
                                        <label for="project_id">Project Name</label>
                                        <select name="project_id" id="project_id" class="form-select col-sm-10 select2"
                                            required>
                                            <option value="">Select Project</option>
                                            @foreach ($project as $proj)
                                                <option value="{{ $proj->id }}">{{ $proj->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><br>
                                <div class="row mb-3">
                                    <div class="form-group col-md-9">
                                        <label for="category_id">Category Name</label>
                                        <select name="category_id" id="category_id" class="form-select col-sm-10 select2"
                                            required>
                                            <option value="">Select Category</option>
                                            @foreach ($category as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><br>
                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Add Plot">
                            </form>
                        </div>
                    </div>
                </div>
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
                    size: {
                        required: true,
                        number: true
                    },
                    project_id: {
                        required: true,
                    },
                    category_id: {
                        required: true,
                    }
                },
                messages: {
                    name: {
                        required: 'Please enter the plot name',
                    },
                    size: {
                        required: 'Please enter the plot size',
                        number: 'Please enter a valid number',
                    },
                    project_id: {
                        required: 'Please select a project',
                    },
                    category_id: {
                        required: 'Please select a category',
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
