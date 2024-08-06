@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Plot</h4><br><br>

                            <form method="POST" action="{{ route('plot.update', $plot->id) }}" id="myForm">
                                @csrf
                                @method('PUT') <!-- Laravel directive for PUT method -->
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-2 col-form-label">Plot Name</label>
                                    <div class="col-sm-10 form-group">
                                        <input class="form-control" id="name" name="name" type="text" required
                                            value="{{ old('name', $plot->name) }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="size" class="col-sm-2 col-form-label">Plot Size</label>
                                    <div class="col-sm-10 form-group">
                                        <input class="form-control" id="size" name="size" type="text" required
                                            value="{{ old('size', $plot->size) }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="form-group col-md-9">
                                        <label for="project_id">Project Name</label>
                                        <select name="project_id" id="project_id" class="form-select col-sm-10 select2"
                                            required>
                                            <option value="">Select Project</option>
                                            @foreach ($projects as $proj)
                                                <option value="{{ $proj->id }}"
                                                    {{ $plot->project_id == $proj->id ? 'selected' : '' }}>
                                                    {{ $proj->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><br>
                                <div class="row mb-3">
                                    <div class="form-group col-md-9">
                                        <label for="category_id">Category Name</label>
                                        <select name="category_id" id="category_id" class="form-select col-sm-10 select2"
                                            required>
                                            <option value="">Select</option>
                                            @foreach ($categories as $cat)
                                                <option value="{{ $cat->id }}"
                                                    {{ $plot->category_id == $cat->id ? 'selected' : '' }}>
                                                    {{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><br>
                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Plot">
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
    <script type="text/javascript">
        $(function() {
            $(document).on('change', '#project_id', function() {
                var project_id = $(this).val();
                $.ajax({
                    url: "{{ route('get-category-invoice') }}",
                    type: 'GET',
                    data: {
                        project_id: project_id,
                    },
                    success: function(data) {
                        var html = '<option value="">Select Category</option>';
                        $.each(data, function(key, v) {
                            html += '<option value="' + v.id + '">' + v.name +
                                '</option>';
                        });
                        $('#category_id').html(html);
                        $('#category_id').val(
                        "{{ old('category_id', $plot->category_id) }}"); // Set the selected category if it was previously selected
                    }
                })
            });

            // Trigger change event to load categories on page load
            $('#project_id').trigger('change');
        });
    </script>
@endsection
