@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">All Invoices</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="pb-4 d-flex justify-content-between">

                                <h4 class="text-base font-semibold">All Invoice Data </h4>

                                <a href="{{ route('add.invoice') }}"
                                    class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right">
                                    <i class="fas fa-plus-circle"></i> Add
                                    Invoice </a>


                            </div>


                            <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Customer Name</th>
                                        <th>Invoice No</th>
                                        <th>Date</th>
                                        <th>Amount(Tsh)</th>
                                        {{-- <th>Action</th> --}}

                                </thead>


                                <tbody>

                                    @foreach ($payments as $key => $payment)
                                        <tr>
                                            <td class=""> {{ $key + 1 }} </td>
                                            <td> {{ $payment->invoice->customer->name }}</td>
                                            <td> #{{ $payment->invoice_id }} </td>
                                            <td> {{ date('d-m-Y', strtotime($payment->date)) }} </td>
                                            <td> {{ number_format($payment->current_paid_amount) }} </td>
                                            {{-- 
                                            <td>

                                                <a href="{{ route('plots.detail.taken', $payment->invoice->id) }}"
                                                    class="btn btn-success sm" title="View Invoice" id="print"> <i
                                                        class="fas fa-eye"></i>
                                                </a>
                                                @if ($payment->invoice->status == 0)
                                                    <a href="#" class="btn btn-warning sm" title="Print Invoice"
                                                        id="print"> Pending
                                                    </a>
                                                @endif
                                            </td> --}}

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->



        </div> <!-- container-fluid -->
    </div>
@endsection
