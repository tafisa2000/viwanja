@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Edit Expense</h4><br><br>

                            <form method="POST" action="{{ route('expense.update', $expense->id) }}" id="myForm">
                                @csrf
                                @method('PUT') <!-- Laravel directive for PUT method -->

                                <div class="row mb-3">
                                    <label for="date" class="col-sm-2 col-form-label">Expense Date</label>
                                    <div class="col-sm-10 form-group">
                                        <input class="form-control example-date-input"
                                            value="{{ old('date', $expense->date) }}" name="date" type="date"
                                            id="date" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="details" class="col-sm-2 col-form-label">Expense Details</label>
                                    <div class="col-sm-10 form-group">
                                        <input class="form-control" name="details" type="text"
                                            value="{{ old('details', $expense->details) }}" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="amount" class="col-sm-2 col-form-label">Amount</label>
                                    <div class="col-sm-10 form-group">
                                        <input class="form-control" name="amount" type="number"
                                            value="{{ old('amount', $expense->amount) }}" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="form-group col-md-9">
                                        <label for="category_id">Category Name</label>
                                        <select name="category_id" id="category_id" class="form-select col-sm-10 select2"
                                            required>
                                            <option value="">Select Category</option>
                                            @foreach ($category as $cat)
                                                <option value="{{ $cat->id }}"
                                                    {{ $cat->id == $expense->category_id ? 'selected' : '' }}>
                                                    {{ $cat->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><br>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <input type="hidden" name="month" class="form-control"
                                            value="{{ old('month', date('F', strtotime($expense->date))) }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <input type="hidden" name="year" class="form-control"
                                            value="{{ old('year', date('Y', strtotime($expense->date))) }}">
                                    </div>
                                </div>

                                <!-- end row -->
                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Expense">
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
                        number: true,
                    },
                },
                messages: {
                    details: {
                        required: 'Please enter expense details',
                    },
                    amount: {
                        required: 'Please enter the expense amount',
                        number: 'Please enter a valid number',
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
