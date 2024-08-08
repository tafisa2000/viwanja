@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- Start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Daily Expense Report</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                                <li class="breadcrumb-item active">Daily Expense Report</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

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

                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="p-2 bg-light">
                                        <h3 class="font-size-16">
                                            <strong>Daily Invoice Report</strong>
                                            <span class="btn btn-info">{{ date('d-m-Y', strtotime($start_date)) }}</span> -
                                            <span class="btn btn-success">{{ date('d-m-Y', strtotime($end_date)) }}</span>
                                        </h3>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap"
                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Sl</th>
                                                    <th>Details</th>
                                                    <th>Amount</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $total_sum = 0;
                                                @endphp
                                                @foreach ($allData as $key => $item)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $item->details }}</td>
                                                        <td>{{ number_format($item->amount, 2) }}</td>
                                                        <td>{{ date('d-m-Y', strtotime($item->date)) }}</td>
                                                    </tr>
                                                    @php
                                                        $total_sum += $item->amount;
                                                    @endphp
                                                @endforeach

                                                <tr>
                                                    <td colspan="2" class="no-line"></td>
                                                    <td class="no-line text-center">
                                                        <strong>Grand Amount:</strong>
                                                    </td>
                                                    <td class="no-line text-end">
                                                        <h4 class="m-0">{{ number_format($total_sum, 2) }} Tsh/=</h4>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="d-print-none mt-4">
                                        <div class="float-end">
                                            <a href="javascript:window.print()"
                                                class="btn btn-success waves-effect waves-light">
                                                <i class="fa fa-print"></i>
                                            </a>
                                            <a href="#"
                                                class="btn btn-primary waves-effect waves-light ms-2">Download</a>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- End row -->

                        </div>
                    </div>
                </div> <!-- End col -->
            </div> <!-- End row -->

        </div> <!-- Container-fluid -->
    </div>
@endsection
