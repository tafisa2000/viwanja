@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">All {{ $expenseCategory->name }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="dropdown mt-4 mt-sm-0">
                    <a href="#" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Filter Expense <i class="mdi mdi-chevron-down"></i>
                    </a>

                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('today.expense') }}">All Expense</a>
                        @foreach ($category as $item)
                            <a class="dropdown-item"
                                href="{{ route('category.expense', $item->id) }}">{{ $item->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <br>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title"> Expense {{ $expenseCategory->name }} Data </h4>

                            <a href="{{ route('expense.add') }}" class="btn btn-dark btn-rounded waves-effect waves-light"
                                style="float:right"><i class="fas fa-ad fas fa-plus-circle"></i>Add Expense</a><br><br>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Details</th>
                                        <th>Amount</th>
                                        <th>Category</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($expense as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->details }}</td>
                                            <td>{{ $item->amount }}</td>
                                            <td>{{ optional($item->category)->name ?? 'N/A' }}</td>
                                            <td>{{ $item->date }}</td>
                                            <td>
                                                {{-- {{ route('edit.expense', $item->id) }} --}}
                                                <a href=""
                                                    class="btn btn-blue rounded-pill waves-effect waves-light">
                                                    <span class="btn btn-warning">Edit</span>
                                                </a>
                                                <a href="{{ route('Expense.delete', $item->id) }}"
                                                    class="btn btn-danger sm" title="Delete Data" id="delete"> <i
                                                        class="fas fa-trash-alt"></i>
                                                </a>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{-- <h4>Total Expense : {{ $totalExpense }}</h4> --}}
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
@endsection
