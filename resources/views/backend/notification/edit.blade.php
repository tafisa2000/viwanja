@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Notification</h4><br><br>
                            <form method="POST" action="{{ route('notification.update') }}" id="myForm">
                                @csrf
                                {{-- @if (isset($category)) --}}
                                <input type="hidden" name="id" value="{{ $notification->id }}">
                                {{-- @endif --}}
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10 form-group">
                                        <input class="form-control" id="name" name="name" type="text"
                                            value="{{ $notification->name ?? '' }}" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-2 col-form-label">Tags</label>
                                    <div class="col-sm-5 form-group">
                                        {{-- <input class="form-control" id="name" name="name" type="text" required> --}}
                                        <h5>
                                            {customer_name} = Customer Name<br>
                                            {invoice_no} = Invoice No<br>
                                            {total_amount} = Total Amount<br>
                                            {total_paid} = Total Paid<br>
                                            {invoice_date} = Invoice Date<br>
                                        </h5>
                                    </div>
                                    <div class="col-sm-5 form-group">
                                        {{-- <input class="form-control" id="name" name="name" type="text" required> --}}
                                        <h5>
                                            {due_amount} = Due Amount<br>
                                            {plot_no} = Plot No<br>
                                            {paid_date} = Paid Date<br>
                                            {paid_amount} = Paid Amount<br>
                                        </h5>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="price" class="col-sm-2 col-form-label">Message</label>
                                    <div class="col-sm-10 form-group">
                                        <textarea class="form-control" id="message" name="message" required>{{ $notification->message ?? '' }}</textarea>
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10 form-group">
                                        <select class="form-control" name="status" required>
                                            <option value="">Select Status</option>
                                            <option value="1"
                                                {{ isset($notification) && $notification->status == 1 ? 'selected' : '' }}>
                                                Active</option>
                                            <option value="0"
                                                {{ isset($notification) && $notification->status == 0 ? 'selected' : '' }}>
                                                Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-info waves-effect waves-light"
                                    value="Update Notification">
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
                    message: {
                        required: true,

                    },
                    status: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: 'Please enter name',
                    },
                    message: {
                        required: 'Please enter massage',

                    },
                    status: {
                        required: 'Please select status',
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
