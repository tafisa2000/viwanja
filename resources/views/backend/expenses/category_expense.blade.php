@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">All Expense</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title"> Expense All Data </h4>

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
                                                <a href="{{ route('Expense.delete', $item->id) }}" class="btn btn-danger sm"
                                                    title="Delete Data" id="delete"> <i class="fas fa-trash-alt"></i>
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
