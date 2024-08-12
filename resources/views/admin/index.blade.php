@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">J.J.MKENYE & SONS COMPANY LTD</a>
                                </li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            {{-- <div>
                <select name="" id="changeLang">
                    <option value="en">English</option>
                    <option value="sw">Swahili</option>
                </select>
            </div> --}}
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    @php
                                        $totalPayment = App\Models\Payment::where('status', 1)->sum('total_amount');
                                    @endphp
                                    <p class="text-truncate font-size-14 mb-2">Total Sales</p>
                                    <h4 class="mb-2">Tsh {{ number_format($totalPayment) }}/=</h4>

                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-primary rounded-3">
                                        <i class="ri-shopping-cart-2-line font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    @php
                                        $paid_amount = App\Models\Payment::where('status', 1)->sum('paid_amount');
                                    @endphp
                                    <p class="text-truncate font-size-14 mb-2">Payed amount</p>
                                    <h4 class="mb-2">Tsh {{ number_format($paid_amount) }}/= </h4>

                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-success rounded-3">
                                        <i class="mdi mdi-currency-usd font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    @php
                                        $due_amount = App\Models\Payment::where('status', 1)->sum('due_amount');
                                    @endphp
                                    <p class="text-truncate font-size-14 mb-2">Due amount</p>
                                    <h4 class="mb-2">Tsh {{ number_format($due_amount) }}/= </h4>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-success rounded-3">
                                        <i class="mdi mdi-currency-usd font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    @php
                                        $totalExpense = App\Models\Expense::sum('amount');
                                    @endphp
                                    <p class="text-truncate font-size-14 mb-2">Total Expense</p>
                                    <h4 class="mb-2">Tsh {{ number_format($totalExpense) }}/= </h4>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-success rounded-3">
                                        <i class="mdi mdi-currency-usd font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        @php
                            $totalCustomers = App\Models\Customer::count();
                        @endphp
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Total Customer</p>
                                    <h4 class="mb-2">{{ $totalCustomers }}</h4>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-primary rounded-3">
                                        <i class="ri-user-3-line font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        @php
                            $thisMonthly = App\Models\Invoice::whereMonth('date', date('m'))
                                ->whereYear('date', date('Y'))
                                ->sum('total_amount');
                        @endphp
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">This Monthly Sale</p>
                                    <h4 class="mb-2">Tsh {{ number_format($thisMonthly) }}/=</h4>

                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-success rounded-3">
                                        <i class="mdi mdi-currency-btc font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        @php
                            $thisMonthlyPayement = App\Models\PaymentDetail::whereMonth('date', date('m'))
                                ->whereYear('date', date('Y'))
                                ->sum('current_paid_amount');
                        @endphp
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">This Monthly Payment</p>
                                    <h4 class="mb-2">Tsh {{ number_format($thisMonthlyPayement) }}/=</h4>

                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-success rounded-3">
                                        <i class="mdi mdi-currency-btc font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        @php
                            $thisMonthlyExpense = App\Models\Expense::whereMonth('date', date('m'))
                                ->whereYear('date', date('Y'))
                                ->sum('amount');
                        @endphp
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">This Month Expense</p>
                                    <h4 class="mb-2">Tsh {{ $thisMonthlyExpense }}/=</h4>

                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-success rounded-3">
                                        <i class="mdi mdi-currency-btc font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->

            <div class="row">

                <!-- end col -->

                <!-- end col -->
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </a>

                            </div>
                            @php
                                $allData = App\Models\Invoice::orderBy('date', 'desc')
                                    ->orderBy('id', 'desc')
                                    ->where('status', 1)
                                    ->get();

                            @endphp
                            <h4 class="card-title mb-4">Latest Transactions</h4>

                            <div class="table-responsive">
                                <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Sl</th>
                                            <th>Customer Name</th>
                                            <th>Sale No</th>
                                            <th>Date</th>
                                            <th>Description</th>
                                            <th style="width: 120px;">Amount</th>
                                        </tr>
                                    </thead><!-- end thead -->
                                    <tbody>
                                        @foreach ($allData as $key => $item)
                                            <tr>
                                                <td> {{ $key + 1 }} </td>
                                                <td>
                                                    {{ $item['customer']['name'] }}
                                                </td>
                                                <td> {{ $item->invoice_no }} </td>
                                                <td> {{ date('d-m-Y', strtotime($item->date)) }} </td>
                                                <td>
                                                    {{ $item->description }}
                                                </td>
                                                <td>
                                                    {{ $item->total_amount }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        <!-- end -->

                                        <!-- end -->
                                    </tbody><!-- end tbody -->
                                </table> <!-- end table -->
                            </div>
                        </div><!-- end card -->
                    </div><!-- end card -->
                </div>
                <div class="col-xl-4">
                    <div class="card">
                        -
                        <h4 class="text-center card-title mb-4">Plots Data</h4>

                        <div class="row">

                            <div class="col-3">
                                <div class="text-center mt-4">
                                    @php
                                        $totalPlots = App\Models\Plot::count();
                                    @endphp
                                    <h5>{{ $totalPlots }}</h5>
                                    <p class="mb-2 text-truncate">Total Plots</p>
                                </div>
                            </div>
                            <div class="col-3">
                                @php
                                    $availablePlots = App\Models\Plot::where('status', 0)->count();
                                @endphp
                                <div class="text-center mt-4">
                                    <h5>{{ $availablePlots }}</h5>
                                    <p class="mb-2 text-truncate">Available Plots</p>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-3">
                                @php
                                    $duePlots = App\Models\Plot::where('status', 1)->count();
                                @endphp
                                <div class="text-center mt-4">
                                    <h5>{{ $duePlots }}</h5>
                                    <p class="mb-2 text-truncate">Due Plots</p>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-3">
                                <div class="text-center mt-4">
                                    @php
                                        $taken = App\Models\Plot::where('status', 2)->count();
                                    @endphp
                                    <h5>{{ $taken }}</h5>
                                    <p class="mb-2 text-truncate">Taken Plots</p>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="mt-4">
                            <div id="donutchart" class="apex-charts"></div>
                        </div>
                    </div>
                </div><!-- end card -->
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var options = {
                        chart: {
                            type: 'donut',
                            height: 300
                        },
                        series: [{{ $availablePlots }}, {{ $duePlots }}, {{ $taken }}],
                        labels: ['Available Plots', 'Due Plots', 'Taken Plots'],
                        colors: ['#ffbb44', '#6fd088', '#0f9cf3'], // Colors for each section
                        legend: {
                            position: 'bottom'
                        },
                        plotOptions: {
                            pie: {
                                donut: {
                                    size: '75%'
                                }
                            }
                        }
                    };

                    var chart = new ApexCharts(document.querySelector("#donutchart"), options);
                    chart.render();
                });
            </script>

            <!-- end col -->
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>

    </div>
@endsection
