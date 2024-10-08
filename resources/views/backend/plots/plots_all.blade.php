@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Plots All</h4>



                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title"> All Plots</h4>

                            <a href="{{ route('plot.add') }}" class="btn btn-dark btn-rounded waves-effect waves-light"
                                style="float:right"><i class="fas fa-ad  fas fa-plus-circle"></i>Add Plots</a><br><br>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th width="5%">Sl</th>
                                        <th>Name</th>
                                        <th>Project</th>
                                        <th>Category</th>
                                        <th>Size</th>
                                        <th>Cost</th>
                                        <th>Status</th>
                                        <th width="20%">Action</th>

                                </thead>


                                <tbody>

                                    @foreach ($plots as $key => $item)
                                        <tr>
                                            <td> {{ $key + 1 }} </td>
                                            <td> {{ $item->name }} </td>
                                            <td> {{ $item['project']['name'] }}</td>
                                            <td> {{ $item['category']['name'] }}</td>
                                            <td> {{ $item->size }} sqm </td>
                                            <td> {{ number_format($item['category']['price'] * $item->size) }} Tsh/= </td>

                                            <td>
                                                @if ($item->status == 0)
                                                    Available
                                                @elseif($item->status == 1)
                                                    Due
                                                @elseif($item->status == 2)
                                                    Taken
                                                @else
                                                    Unknown
                                                @endif
                                            </td>


                                            <td>
                                                <a href="{{ route('plot.edit', $item->id) }}" class="btn btn-info sm"
                                                    title="Edit Data">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <a href="{{ route('plots.delete', $item->id) }}" class="btn btn-danger sm"
                                                    title="Delete Data" id="delete"> <i class="fas fa-trash-alt"></i>
                                                </a>
                                                @if ($item->status == 1)
                                                    <a href="{{ route('plots.detail', $item->id) }}" class="btn btn-dark sm"
                                                        title="Detail Data" id="detail"> <i class="fas fa-eye"></i>
                                                    </a>
                                                @elseif($item->status == 2)
                                                    <a href="{{ route('plots.detail.taken', $item->id) }}"
                                                        class="btn btn-dark sm" title="Detail Data" id="detail"> <i
                                                            class="fas fa-eye"></i>
                                                    </a>
                                                @endif


                                            </td>

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
