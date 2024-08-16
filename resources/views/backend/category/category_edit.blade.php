@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Project Category</h4><br><br>
                            <form method="POST" action="{{ route('projectCategory.update', $category->id) }}" id="myForm">
                                @csrf
                                @method('PUT')

                                <div class="row mb-3">
                                    <label for="name" class="col-sm-2 col-form-label">Project Category Name</label>
                                    <div class="col-sm-10 form-group">
                                        <input class="form-control" id="name" name="name" type="text"
                                            value="{{ old('name', $category->name) }}" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="price" class="col-sm-2 col-form-label">Project Price (in sqm)</label>
                                    <div class="col-sm-10 form-group">
                                        <input class="form-control input-mask" id="price" name="price" type="text"
                                            value="{{ old('price', number_format($category->price, 2)) }}" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="form-group col-md-9">
                                        <label for="project_id">Project Name</label>
                                        <select name="project_id" id="project_id" class="form-select select2" required>
                                            <option value="">Select Project</option>
                                            @foreach ($projects as $proj)
                                                <option value="{{ $proj->id }}"
                                                    {{ $proj->id == old('project_id', $category->project_id) ? 'selected' : '' }}>
                                                    {{ $proj->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><br>
                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Category">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            // Initialize InputMask for the price field
            $('#price').inputmask({
                alias: 'numeric',
                groupSeparator: ',',
                digits: 2,
                digitsOptional: false,
                prefix: '',
                placeholder: '0',
                rightAlign: false,
                removeMaskOnSubmit: true // This will remove the mask when form is submitted
            });

            $('#myForm').validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 255
                    },
                    price: {
                        required: true,
                        number: true
                    },
                    project_id: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: 'Please enter the project category name',
                        maxlength: 'The project category name cannot be longer than 255 characters'
                    },
                    price: {
                        required: 'Please enter the project price',
                        number: 'Please enter a valid number',
                    },
                    project_id: {
                        required: 'Please select a project',
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
