@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->

            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="" style="background-color: white">
                        <div class="card-body">

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
                            <div class="row">
                                <div class="col-12">
                                    <div>
                                        <div class="p-2">
                                            <h3 class="font-size-16"><strong>Invoice Details</strong></h3>
                                        </div>
                                        <div class="">
                                            <div class="table-responsive">
                                                <div class="border p-3 mb-4">
                                                    <h5 class="mb-3"><strong>Customer Info</strong></h5>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <p>Name:
                                                                <strong>{{ $invoice->payment->customer->name }}</strong>
                                                            </p>
                                                        </div>
                                                        <div class="col-4">
                                                            <p>Mobile:
                                                                <strong>{{ $invoice->payment->customer->mobile_no }}</strong>
                                                            </p>
                                                        </div>
                                                        <div class="col-4">
                                                            <p>Email:
                                                                <strong>{{ $invoice->payment->customer->email }}</strong>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <table class="table">


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
                                                        @php
                                                            $total_sum = '0';
                                                        @endphp
                                                        @foreach ($invoice->invoiceDetail as $key => $details)
                                                            <tr>
                                                                <td class="text-center">{{ $key + 1 }}</td>
                                                                <td class="text-center">{{ $details->project->name }}</td>
                                                                <td class="text-center">{{ $details->plot->name }}</td>
                                                                <td class="text-center">{{ number_format($details->size) }}
                                                                </td>
                                                                <td class="text-center">{{ number_format($details->price) }}
                                                                </td>
                                                            </tr>
                                                            @php
                                                                $total_sum += $details->price;
                                                            @endphp
                                                        @endforeach
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
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="d-print-none">
                                                <div class="float-end">
                                                    <a href="javascript:window.print()"
                                                        class="btn btn-success waves-effect waves-light"><i
                                                            class="fa fa-print"></i></a>
                                                    <a href="#"
                                                        class="btn btn-primary waves-effect waves-light ms-2">Send</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div> <!-- end row -->

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->



        </div> <!-- container-fluid -->
    </div>
@endsection
