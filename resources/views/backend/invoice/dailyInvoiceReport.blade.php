@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-7">
                    <div class="card">
                        <div class="card-body">

                            <h1 class="card-title" style="font-size: 18px; font-weight: 900">Daily Invoice Report</h1>
                            <form action="{{ route('get.daily.invoice.report') }}" method="get" id="myForm">
                                <div class="mt-3 row">

                                    <div class="col-md-5 form-group">
                                        <div class="md-3">
                                            <label for="example-text-input" class="form-label">Start Date</label>
                                            <input name="start_date" class="form-control example-date-input" type="date"
                                                id="start_date">
                                        </div>
                                    </div>
                                    <div class="col-md-5 form-group">
                                        <div class="md-3">
                                            <label for="example-text-input" class="form-label">End Date</label>
                                            <input name="end_date" class="form-control example-date-input" type="date"
                                                id="end_date">
                                        </div>
                                    </div>

                                    <div class=" col-md-2 d-flex flex-column justify-content-end">
                                        <div class="md-3">
                                            <button type="submit"
                                                class="btn btn-dark btn-rounded waves-effect waves-light addeventmore">
                                                Search
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>


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
                    start_date: {
                        required: true,
                    },
                    end_date: {
                        required: true,
                    },

                },
                messages: {
                    start_date: {
                        required: 'Please select start date',
                    },
                    end_date: {
                        required: 'Please select end date',
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
