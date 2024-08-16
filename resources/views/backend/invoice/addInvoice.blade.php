@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h1 class="card-title" style="font-size: 18px; font-weight: 900">Add Invoice Page</h1>
                            <div class="mt-3 row">
                                <div class="col-md-2">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Invoice No</label>
                                        <input name="invoice_no" class="bg-gray-400 form-control example-date-input"
                                            type="text" id="invoice_no" value="{{ $invoice_no }}" readonly>
                                    </div>
                                </div>
                                <div class="pb-3 col-md-3">

                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Customer
                                            Name</label>
                                        <select name="customer_id" id="customer_id" class="form-select select2"
                                            aria-label="Default select example">
                                            <option>select</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="-ml-3 col-md-2 d-flex flex-column justify-content-center">
                                    <div class="pt-[29px] md-3">
                                        <a href="{{ route('add.customer') }}"
                                            class="btn btn-dark btn-rounded waves-effect waves-light">

                                            <i class="fas fa-plus-circle">
                                                New
                                                Customer</i>
                                        </a>


                                    </div>
                                </div>
                                <div class=" col-md-4">

                                </div>
                                <div class="col-md-2">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Date</label>
                                        <input name="date" value="{{ $date }}"
                                            class="form-control example-date-input" type="date" id="date">
                                    </div>
                                </div>


                                {{-- <div class="col-md-3">

                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Category
                                            Name</label>
                                        <select name="category_id" class="form-select select2"
                                            aria-label="Default select example" id="category_id">
                                            <option selected="">select</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="col-md-3">

                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Project</label>
                                        <select name="project_id" id="project_id" class="form-select select2"
                                            aria-label="Default select example">
                                            <option selected="">select project</option>
                                            @foreach ($projects as $project)
                                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">

                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Category</label>
                                        <select name="category_id" id="category_id" class="form-select select2"
                                            aria-label="Default select example">
                                            <option selected="">select</option>
                                            {{-- @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">

                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Plot Number</label>
                                        <select name="plot_id" id="plot_id" class="form-select select2"
                                            aria-label="Default select example">
                                            <option selected="">select</option>
                                            {{-- @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 d-none">

                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Plot Size</label>
                                        <select name="size" id="size" class="form-select select2"
                                            aria-label="Default select example">
                                            <option selected="">select</option>
                                            {{-- @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 d-none">

                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Plot Price</label>
                                        <select name="price" id="price" class="form-select select2"
                                            aria-label="Default select example">
                                            <option selected="">select</option>
                                            {{-- @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 d-none">

                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Plot Name</label>
                                        <select name="name" id="name" class="form-select select2"
                                            aria-label="Default select example">
                                            <option selected="">select</option>
                                            {{-- @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                </div>



                                <div class="-ml-16 col-md-1 d-flex flex-column justify-content-end">
                                    <div class=" md-3">
                                        <span class="btn btn-dark btn-rounded waves-effect waves-light addeventmore">

                                            <i class="fas fa-plus-circle">
                                                Add
                                            </i>
                                        </span>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('store.invoice') }}" method="post">
                                @csrf
                                <table class="border-blue-900 table-sm table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            {{-- <th>Category</th> --}}
                                            <th>Project</th>
                                            <th>Plot Number</th>
                                            <th>Size(Sqm)</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="addRow" id="addRow">

                                    </tbody>
                                    <tbody>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td class="text-xl font-bold text-center ">Discount</td>
                                            <td>
                                                <input type="number" min="0" name="discount_amount"
                                                    id="discount_amount" class="form-control discount_amount"
                                                    placeholder="Discount Amount">
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td class="text-xl font-bold text-center ">Grand Total</td>
                                            <td>
                                                <input type="text" name="estimated_amount" value="0"
                                                    id="estimated_amount"
                                                    class="bg-gray-400 form-control estimated_amount" readonly>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>

                                </table>
                                <br>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <textarea name="description" class="h-20 form-control" id="description" cols="30" rows="5"
                                            placeholder="Write description here"></textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="">Paid Status</label>
                                        <select name="paid_status" id="paid_status" class="form-select">
                                            <option value="">select</option>
                                            <option value="full_paid">Full Paid</option>
                                            <option value="partial_paid">Partial Paid</option>
                                            <option value="full_due">Full Due</option>
                                        </select>
                                        <br>
                                        <input name="paid_amount" class="hidden form-control paid_amount input-mask"
                                            id="input-currency"
                                            data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': '', 'placeholder': '0'"
                                            placeholder="Enter Paid Amount" style="display: none">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="">Payment Method</label>
                                        <select name="payment_method" id="payment_method" class="form-select">
                                            <option value="">select</option>
                                            @foreach ($paymentMethods as $paymentMethod)
                                                <option value="{{ $paymentMethod->id }}">{{ $paymentMethod->name }}
                                                </option>
                                            @endforeach

                                        </select>

                                    </div>



                                    <div class="flex justify-end form-group">
                                        <button type="submit" class="btn btn-dark btn-rounded waves-effect waves-light"
                                            style="float:right">Add
                                            Invoice</button>
                                    </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
    </div>

    <script src="{{ asset('backend/assets/js/notify.js') }}"></script>
    <script id="document-template" type="text/x-handlebars-template">
        <tr class = "delete_add_more_item"
        id = "delete_add_more_item" >
            <input type = "hidden"
        name = "date"
        value = "@{{ date }}">
            <input type = "hidden"
        name = "customer_id"
        value = "@{{ customer_id }}">
            <input type = "hidden"
        name = "invoice_no"
        value = "@{{ invoice_no }}" >
            <input type = "hidden"
        name = "category_id[]"
        value = "@{{ category_id }}" >



            <td >
            <input type = "hidden"
        name = "project_id[]"
        value = "@{{ project_id }}" >
            @{{ project_name }}
            </td>
             <td >

            <input type = "hidden"
        class = "text-left form-control unit_price"
        name = "plot_id[]"
        value = "@{{ plot_id }}" >
        @{{plot_name}}

        </td>
            <td >
            <input type = "hidden"
        min = "1"
        class = "text-left form-control selling_qty"
        name = "size[]"
        value = "@{{ size }}" >
        @{{ size }}
            </td>


        <td >

            <input type = "number"
        class = "text-left form-control price"
        name = "price[]"
        value = "@{{ price }}"
        readonly >

        </td>
        <td >
            <i class = "btn btn-danger btn-sm fas fa-window-close removeeventmore" > </i>
                </td >
            </tr>
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '.addeventmore', function() {
                var date = $('#date').val();
                var invoice_no = $('#invoice_no').val();
                var category_id = $('#category_id').val();
                var category_name = $('#category_id').find('option:selected').text();
                var plot_id = $('#plot_id').val();
                var plot_name = $('#plot_id').find('option:selected').text();
                var customer_id = $('#customer_id').val();
                var project_id = $('#project_id').val();
                var project_name = $('#project_id').find('option:selected').text();
                // get #size value from select option by plot_id


                var size = $('#size').val(plot_id);
                var price = $('#price').val(plot_id);
                var name = $('#name').val(plot_id);
                size = $('#size').find('option:selected').text();
                price = $('#price').find('option:selected').text();
                name = $('#name').find('option:selected').text();
                size = parseFloat(size);
                price = parseFloat(price);
                // price = new Intl.NumberFormat('en-US').format(price)
                // console.log(size);

                if (!parseFloat(invoice_no)) {
                    toastr.error('Invoice No is required');
                    return false;
                }
                if (!parseFloat(customer_id)) {
                    toastr.error('Customer Name is required');
                    return false;
                }
                if (date == '') {
                    toastr.error('Date is required');
                    return false;
                }
                if (!parseFloat(project_id)) {
                    toastr.error('Project is required');
                    return false;
                }

                if (!parseFloat(category_id)) {
                    // alert('Category is required');
                    toastr.error("Category is required");

                    return false;
                }

                if (!parseFloat(plot_id)) {
                    toastr.error('Plot Number is required');
                    return false;
                }



                var source = $('#document-template').html();
                var tamplate = Handlebars.compile(source);
                var data = {
                    date: date,
                    invoice_no: invoice_no,
                    category_id: category_id,
                    category_name: category_name,
                    customer_id: customer_id,
                    project_id: project_id,
                    project_name: project_name,
                    plot_id: plot_id,
                    plot_name: name,
                    size: size,
                    price: price
                };
                var html = tamplate(data);
                $('#addRow').prepend(html);
                totalAmountPrice();
            });

            $(document).on('click', '.removeeventmore', function(event) {
                $(this).closest('.delete_add_more_item').remove();
                totalAmountPrice();
            });

            $(document).on('keyup click', '.unit_price,.selling_qty', function() {
                var unit_price = $(this).closest('tr').find('input.unit_price').val();
                var qty = $(this).closest('tr').find('input.selling_qty').val();
                var total = unit_price * qty;
                $(this).closest('tr').find('input.selling_price').val(total);
                // $('#discount_amount').trigger('keyup');
                totalAmountPrice();
            });

            $(document).on('keyup', '#discount_amount', function() {
                totalAmountPrice();
            })

            function totalAmountPrice() {
                var sum = 0;
                $('.price').each(function() {
                    var value = $(this).val();
                    if (!isNaN(value) && value.length != 0) {
                        sum += parseFloat(value);
                    }
                });
                var discount = parseFloat($('#discount_amount').val());
                if (!isNaN(discount) && discount.length != 0) {
                    sum -= parseFloat(discount);
                }

                $('#estimated_amount').val(sum);
            }

        })
    </script>

    <script type="text/javascript">
        $(function() {
            $(document).on('change', '#category_id', function() {
                var category_id = $(this).val();
                // var category_id = $('#category_id').val();
                $.ajax({
                    url: "{{ route('get-plot-invoice') }}",
                    type: 'GET',
                    data: {
                        category_id: category_id,
                        // product_id: product_id
                    },
                    success: function(data) {
                        var html = '<option value="">Select Plot</option>';
                        var size = '<option value="">Select Plot</option>';
                        var price = '<option value="">Select Plot</option>';
                        var name = '<option value="">Select Plot</option>';
                        $.each(data, function(key, v) {
                            size += '<option value="' + v.id +
                                '">' + v.size + '</option>';
                            price += '<option value="' + v.id +
                                '">' + v.price + '</option>';
                            name += '<option value="' + v.id +
                                '">' + v.name + '</option>';
                            html += '<option value="' + v.id +
                                '">' + v.name + ' (' + v.size + 'sqm)' + '</option>';
                        });
                        $('#size').html(size);
                        $('#price').html(price);
                        $('#name').html(name);

                        $('#plot_id').html(html);
                    }
                })
            })
        })
    </script>
    <script type="text/javascript">
        $(function() {
            $(document).on('change', '#project_id', function() {
                var project_id = $(this).val();
                $.ajax({
                    url: "{{ route('get-category-invoice') }}",
                    type: 'GET',
                    data: {
                        project_id: project_id,
                    },
                    success: function(data) {
                        var html = '<option value="">Select Category</option>';
                        $.each(data, function(key, v) {
                            // html += '<option value="' + v.id +
                            //     '">' + v.name + '(' + v.size + ')' + '</option>'
                            html += '<option value="' + v.id +
                                '">' + v.name + '</option>'
                        });
                        $('#category_id').html(html);
                    }
                })
            })
        })
    </script>
    <script type="text/javascript">
        $(document).on('change', '#paid_status', function() {
            var paid_status = $(this).val();
            if (paid_status == 'partial_paid') {
                $('.paid_amount').show();
            } else {
                $('.paid_amount').hide();
            }
        });
    </script>
@endsection
