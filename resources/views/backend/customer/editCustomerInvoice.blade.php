@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">
            <!-- Invoice Header -->


            <!-- Invoice Card -->
            <div class="row">
                <div class="col-12">
                    {{-- shadow-lg --}}
                    <div class="" style="background-color: white">
                        <div class="card-body">
                            <!-- Invoice Header -->
                            <div class="d-flex justify-content-between mb-4">
                                <div>
                                    <h3 style="color:black;text-align:start;font-size: 20px; margin-top: 10px; ">

                                        <strong> J.J.MKENYE & SONS <br> <span> </span> COMPANY LTD
                                    </h3> </strong>
                                    </a>
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

                            <div class="row">
                                <div class="col-12">
                                    <form id="myForm" action="{{ route('update.customer.invoice', $invoice->id) }}"
                                        method="POST">
                                        @csrf
                                        <div>
                                            <div class="p-2">
                                                <h3 class="font-size-16"><strong>Invoice Details</strong></h3>
                                            </div>
                                            <div class="">
                                                {{--  --}}


                                                {{-- <div class="d-print-none">
                                                    <div class="float-end">
                                                        <a href="javascript:window.print()"
                                                            class="btn btn-success waves-effect waves-light"><i
                                                                class="fa fa-print"></i></a>
                                                        <a href="#"
                                                            class="btn btn-primary waves-effect waves-light ms-2">Send</a>
                                                    </div>
                                                </div> --}}
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
                                                                <td class="text-center">
                                                                    {{ number_format($details->size) }}</td>
                                                                <td class="text-center">
                                                                    {{ number_format($details->price) }}</td>
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
                                                                    {{ number_format($invoice->payment->discount_amount) }}
                                                                </td>
                                                            </tr>
                                                        @endif
                                                        <tr>
                                                            <td colspan="3"></td>
                                                            <td class="text-end"><strong>Paid Amount</strong></td>
                                                            <td class="text-center">
                                                                {{ number_format($invoice->payment->paid_amount) }}
                                                            </td>
                                                        </tr>
                                                        @if ($invoice->payment->due_amount)
                                                            <tr>
                                                                <td colspan="3"></td>
                                                                <td class="text-end"><strong>Due Amount</strong></td>
                                                                <td class="text-center">
                                                                    {{ number_format($invoice->payment->due_amount) }}
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
                                                            <td colspan="6" class="text-center text-uppercase bg-light">
                                                                <strong>Payment
                                                                    Summary</strong>
                                                            </td>
                                                        </tr>
                                                        <tr class="bg-light">
                                                            <td colspan="2"></td>
                                                            <td class="text-center"><strong>Date</strong></td>
                                                            <td class="text-center"><strong>Amount</strong></td>
                                                            <td class="text-center"><strong>Method</strong></td>

                                                        </tr>
                                                        @foreach ($invoice->paymentDetail as $key => $item)
                                                            <tr>
                                                                <td colspan="2"></td>
                                                                <td class="text-center">
                                                                    {{ date('d-m-Y', strtotime($item->date)) }}</td>
                                                                <td class="text-center">
                                                                    {{ number_format($item->current_paid_amount) }}
                                                                </td>
                                                                <td class="text-center">{{ $item->method }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- End Invoice Details -->
                                            <!-- Print and Send Options -->
                                            <div class="row mt-4">
                                                <div class="col-md-12 text-end d-print-none">
                                                    <button type="button" class="btn btn-success" onclick="window.print()">
                                                        <i class="fa fa-print"></i> Print
                                                    </button>
                                                    <button type="button" class="btn btn-primary ms-2">Send</button>
                                                </div>
                                            </div>
                                            <input type="numbser" style="display: none" name="due_amount"
                                                value="{{ $invoice->payment->due_amount }}">
                                            <!-- Update Invoice Form (Hidden in Print) -->
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label for="">Paid Status</label>
                                                    <select name="paid_status" id="paid_status" class="form-select">
                                                        <option value="">select</option>
                                                        <option value="full_paid">Full Paid</option>
                                                        <option value="partial_paid">Partial Paid</option>
                                                    </select>
                                                    <input name="paid_amount" class="form-control input-mask paid_amount"
                                                        placeholder="Enter Paid Amount" id="input-currency"
                                                        data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': '', 'placeholder': '0'"
                                                        style="display: none;">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="">Payment Method</label>
                                                    <select name="payment_method" class="form-select">
                                                        <option value="">select</option>
                                                        <option value="cash">Cash</option>
                                                        <option value="check">Check</option>
                                                        <option value="card">Card</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-3 ">
                                                    <div class="md-3">
                                                        <label for="example-text-input" class="form-label">
                                                            Date</label>
                                                        <input name="date" class="form-control example-date-input"
                                                            type="date" id="date">
                                                    </div>
                                                </div>

                                                <div class=" form-group col-md-3 d-flex flex-column justify-content-end">
                                                    <div class="md-3">
                                                        <button type="submit"
                                                            class="btn btn-dark btn-rounded waves-effect waves-light">Update
                                                            Invoice </button>
                                                    </div>
                                                </div>

                                            </div>
                                            {{-- <div class="row mt-4 d-print-none">
                                                <div class="col-md-4">
                                                    <form id="myForm"
                                                        action="{{ route('update.customer.invoice', $invoice->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="form-group mb-3">
                                                            <label for="paid_status">Paid Status</label>
                                                            <select name="paid_status" id="paid_status"
                                                                class="form-select">
                                                                <option value="">Select</option>
                                                                <option value="full_paid">Full Paid</option>
                                                                <option value="partial_paid">Partial Paid</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group mb-3 paid_amount" style="display: none;">
                                                            <label for="paid_amount">Enter Paid Amount</label>
                                                            <input type="number" name="paid_amount"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            <label for="date">Date</label>
                                                            <input name="date" class="form-control" type="date"
                                                                id="date">
                                                        </div>
                                                        <button type="submit" class="btn btn-dark">Update
                                                            Invoice</button>
                                                    </form>
                                                </div>
                                            </div> --}}

                                            <!-- Print Time (Hidden in Print) -->
                                            <div class="row mt-4 d-print-none">
                                                <div class="col-md-12">
                                                    <p class="text-muted">
                                                        <i>Print Time:
                                                            {{ (new DateTime('now', new DateTimeZone('Africa/Nairobi')))->format('F j, Y, g:i a') }}</i>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                    </div> <!-- container-fluid -->
                </div>

                <script type="text/javascript">
                    $(document).ready(function() {
                        $('#date').val(new Date().toJSON().slice(0, 10));
                        $('#myForm').validate({
                            rules: {
                                paid_status: {
                                    required: true
                                },
                                paid_amount: {
                                    required: true
                                },
                                date: {
                                    required: true,
                                },

                                payment_method: {
                                    required: true,
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
                                    required: 'Please select Date',
                                },
                                payment_method: {
                                    required: 'Please select Payment Method',
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
                            }
                        });

                        $('#paid_status').change(function() {
                            if ($(this).val() === 'partial_paid') {
                                $('.paid_amount').show();
                            } else {
                                $('.paid_amount').hide();
                            }
                        });
                    });
                </script>
            @endsection
