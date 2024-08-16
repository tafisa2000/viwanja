@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Payment Method</h4><br><br>

                            <form method="POST" action="{{ route('payment_methods.update', $paymentMethod->id) }}"
                                id="myForm">
                                @csrf
                                @method('PUT') <!-- Laravel directive for PUT method -->
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10 form-group">
                                        <input class="form-control" id="name" name="name" type="text" required
                                            value="{{ old('name', $paymentMethod->name) }}">
                                    </div>
                                </div>
                                <br>
                                <div class="d-flex justify-content-end">

                                    <input type="submit" class="btn btn-dark waves-effect waves-light"
                                        value="Update Payment Method">
                                </div>
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
