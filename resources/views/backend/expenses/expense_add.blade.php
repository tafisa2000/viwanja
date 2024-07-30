@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Add Category Page</h4><br><br>

                            <form method="POST" action="{{ route('expense.store') }}" id="myForm">
                                @csrf

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Expense Date</label>
                                    <div class="col-sm-10 form-group">
                                        <input class="form-control example-date-input" value="{{ $date }}"
                                            name="date" type="date" id="date">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Expense Details</label>
                                    <div class="col-sm-10 form-group">
                                        <input class="form-control" name="details" type="text">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Amount</label>
                                    <div class="col-sm-10 form-group">
                                        <input class="form-control" name="amount" type="number">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="form-group col-md-9">
                                        <label for="project_id">Category Name</label>
                                        <select name="category_id" id="category_id" class="form-select col-sm-10 select2"
                                            required>
                                            <option value="">Select Project</option>
                                            @foreach ($category as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><br>
                                {{-- <div class="col-md-12">
                                    <div class="mb-3">

                                        <input type="hidden" name="date" class="form-control"
                                            value="{{ date('d-m-Y') }}">
                                    </div>
                                </div> --}}

                                <div class="col-md-12">
                                    <div class="mb-3">

                                        <input type="hidden" name="month" class="form-control"
                                            value="{{ date('F') }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">

                                        <input type="hidden" name="year" class="form-control"
                                            value="{{ date('Y') }}">
                                    </div>
                                </div>


                                <!-- end row -->
                                <input type="submit" class="btn btn-info waves-effect waves-light" value="add expense">
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
                    details: {
                        required: true,
                    },
                    amount: {
                        required: true,
                    },
                },


                messages: {
                    details: {
                        required: 'Please Enter Expense details',
                    },
                    amount: {
                        required: 'Please Enter Expense Amount',
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
