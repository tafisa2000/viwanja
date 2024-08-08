@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">

            <!-- Start Page Title -->

            <!-- End Page Title -->

            <!-- Invoice Card -->
            <div class="row ">
                <div class="col-12">
                    <div class="" style="background-color: white">
                        <div class="card-body">
                            <!-- Invoice Header -->
                            <div class="d-flex justify-content-between mb-4">
                                <div>
                                    <h3 style="color:black;text-align:start;font-size: 20px; margin-top: 10px; ">
                                        <strong> J.J.MKENYE & SONS <br> <span> </span> COMPANY LTD
                                    </h3> </strong>
                                    <address class="text-muted">
                                        Kigamboni Gezaulole,<br> Dar-es-Salaam, Tanzania.<br>
                                        johnmkenye1980@gmail.com <br>
                                        Phone : 0685202861
                                    </address>
                                </div>
                                <div class="text-end">
                                    <h4><strong>Invoice No #{{ $invoice->invoice_no }}</strong></h4>
                                    <address class="text-muted">
                                        <strong>Invoice Date:</strong> {{ date('d-m-Y', strtotime($invoice->date)) }}
                                    </address>
                                </div>
                            </div>
                            <!-- End Invoice Header -->

                            <!-- Customer Information -->
                            <div class="border p-3 mb-4">
                                <h5 class="mb-3"><strong>Customer Info</strong></h5>
                                <div class="row">
                                    <div class="col-4">
                                        <p>Name: <strong>{{ $invoice->payment->customer->name }}</strong></p>
                                    </div>
                                    <div class="col-4">
                                        <p>Mobile: <strong>{{ $invoice->payment->customer->mobile_no }}</strong></p>
                                    </div>
                                    <div class="col-4">
                                        <p>Email: <strong>{{ $invoice->payment->customer->email }}</strong></p>
                                    </div>
                                </div>
                            </div>
                            <!-- End Customer Information -->

                            <!-- Invoice Details -->
                            <div class="table-responsive mb-4">
                                <table class="table table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center">Sl</th>
                                            <th class="text-center">Project Name</th>
                                            <th class="text-center">Plot Number</th>
                                            <th class="text-center">Size (Sqm)</th>
                                            <th class="text-center">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $total_sum = 0; @endphp
                                        @foreach ($invoice->invoiceDetail as $key => $details)
                                            <tr>
                                                <td class="text-center">{{ $key + 1 }}</td>
                                                <td class="text-center">{{ $details->project->name }}</td>
                                                <td class="text-center">{{ $details->plot->name }}</td>
                                                <td class="text-center">{{ number_format($details->size) }}</td>
                                                <td class="text-center">{{ number_format($details->price) }}</td>
                                            </tr>
                                            @php $total_sum += $details->price; @endphp
                                        @endforeach
                                        <!-- Subtotals and Summary -->
                                        <tr>
                                            <td colspan="3"></td>
                                            <td class="text-end"><strong>Sub Total</strong></td>
                                            <td class="text-center">{{ number_format($total_sum) }}</td>
                                        </tr>
                                        @if ($invoice->payment->discount_amount)
                                            <tr>
                                                <td colspan="3"></td>
                                                <td class="text-end"><strong>Discount</strong></td>
                                                <td class="text-center">
                                                    {{ number_format($invoice->payment->discount_amount) }}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td colspan="3"></td>
                                            <td class="text-end"><strong>Paid Amount</strong></td>
                                            <td class="text-center">{{ number_format($invoice->payment->paid_amount) }}
                                            </td>
                                        </tr>
                                        @if ($invoice->payment->due_amount)
                                            <tr>
                                                <td colspan="3"></td>
                                                <td class="text-end"><strong>Due Amount</strong></td>
                                                <td class="text-center">{{ number_format($invoice->payment->due_amount) }}
                                                </td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td colspan="3"></td>
                                            <td class="text-end">
                                                <h5><strong>Grand Total</strong></h5>
                                            </td>
                                            <td class="text-center">
                                                <h5><strong>Tsh
                                                        {{ number_format($invoice->payment->total_amount, 2) }}</strong>
                                                </h5>
                                            </td>
                                        </tr>
                                        <!-- Payment Summary -->
                                        <tr>
                                            <td colspan="6" class="text-center text-uppercase bg-light"><strong>Payment
                                                    Summary</strong></td>
                                        </tr>
                                        <tr class="bg-light">
                                            <td colspan="3"></td>
                                            <td class="text-center"><strong>Date</strong></td>
                                            <td class="text-center"><strong>Amount</strong></td>
                                        </tr>
                                        @foreach ($invoice->paymentDetail as $key => $item)
                                            <tr>
                                                <td colspan="3"></td>
                                                <td class="text-center">{{ date('d-m-Y', strtotime($item->date)) }}</td>
                                                <td class="text-center">{{ number_format($item->current_paid_amount) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- End Invoice Details -->

                            <!-- Print Time and Buttons -->
                            <div class="d-flex justify-content-between">
                                @php $date = new DateTime('now', new DateTimeZone('Africa/Nairobi')); @endphp
                                <p class="text-muted"><i>Print Time: {{ $date->format('F j, Y, g:i a') }}</i></p>
                                <div class="no-print">
                                    <a href="javascript:window.print()" class="btn btn-success"><i class="fa fa-print"></i>
                                        Print</a>
                                    <a href="#" class="btn btn-primary ms-2">Send</a>
                                </div>
                            </div>
                            <!-- End Print Time and Buttons -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Invoice Card -->
        </div> <!-- container-fluid -->
    </div>

    <!-- Validation Script -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    paid_status: {
                        required: true
                    },
                    paid_amount: {
                        required: true
                    },
                    date: {
                        required: true
                    },
                },
                messages: {
                    paid_status: {
                        required: 'Please Select Paid Status'
                    },
                    paid_amount: {
                        required: 'Please Enter Paid Amount'
                    },
                    date: {
                        required: 'Please select Date'
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>

    <!-- Show/Hide Paid Amount Based on Status -->
    <script type="text/javascript">
        $(function() {
            $(document).on('change', '#paid_status', function() {
                var paid_status = $(this).val();
                if (paid_status === 'partial_paid') {
                    $('.paid_amount').show();
                } else {
                    $('.paid_amount').hide();
                }
            });
        })
    </script>

    <!-- Print-Specific CSS -->
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
@endsection
