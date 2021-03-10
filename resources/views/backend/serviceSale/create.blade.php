@extends('backend._partial.dashboard')
<style>
    .requiredCustom{
        font-size: 20px;
        color: red;
    }
</style>

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class=""></i> Add Service Sale </h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('serviceSale.index') }}" class="btn btn-sm btn-primary col-sm" type="button">All Service Sale </a>
                </li>
            </ul>
        </div>
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Add Service Sale </h3>
                <div class="tile-body tile-footer">
                    @if(session('response'))
                        <div class="alert alert-success">
                            {{ session('response') }}
                        </div>
                    @endif
                    <form  class="row" method="post" action="{{ route('serviceSale.store') }}">
                        @csrf
                            <div class="form-group col-md-4">
                                <label class="control-label text-right">Customers <small class="requiredCustom">*</small></label>
                                <select class="form-control select2 " name="customer_id" required>
                                    <option value="">Select Customer</option>
                                    @foreach($customers as $customer)
                                        <option value="{{$customer->id}}">{{$customer->name}} </option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group col-md-4">
                                <input type="hidden" name="service_sale_id" id="service_sale_id" class="form-control" >
                                <label class="control-label  text-right">Payment Type  <small class="requiredCustom">*</small></label>
                                <select name="payment_type" id="payment_type" class="form-control" >
                                    <option value="cash" selected>cash</option>
                                    <option value="check">check</option>
                                </select>
                                <span>&nbsp;</span>
                                <input type="text" name="check_number" id="check_number" class="form-control" placeholder="Check Number">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label text-right">Date  <small class="requiredCustom">*</small></label>
                                <input type="text" name="date" class="datepicker form-control" value="{{date('Y-m-d')}}">
                            </div>


                        <div class="table-responsive">
                            <input type="button" class="btn btn-primary add " style="margin-left: 804px;" value="Add More Product">
                            <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th >ID</th>
                                <th>Service <small class="requiredCustom">*</small></th>
                                <th >Sub Category</th>
                                <th>Qty <small class="requiredCustom">*</small></th>
                                <th>Price <small class="requiredCustom">*</small></th>
                                <th>Unit <small class="requiredCustom">*</small></th>
                                <th>Vat</th>
                                <th>Sub Total</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody class="neworderbody">
                            <tr>

                                <td width="5%" class="no">1</td>
                                <td>
                                    <select class="form-control service_id select2" name="service_id[]" id="service_id_1" onchange="getval(1,this);" required>
                                        <option value="">Select  Service</option>
                                        @foreach($services as $service)
                                            <option value="{{$service->id}}">{{$service->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td width="15%" >
                                    <div id="service_sub_category_id_1">
                                        <select class="form-control service_sub_category_id select2" name="service_sub_category_id[]" >
                                            <option value="">Select  Sub Category</option>
                                            @foreach($serviceSubCategories as $serviceSubCategory)
                                                <option value="{{$serviceSubCategory->id}}">{{$serviceSubCategory->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <input type="text" min="1" max="" class="qty form-control" name="qty[]" value="" required >
                                </td>
                                <td>
                                    <input type="text" min="1" max="" class="price form-control" name="price[]" value="" required >
                                </td>
                                <td  width="10%">
                                    <div id="service_unit_id_1">
                                        <select class="form-control service_unit_id select2" name="service_unit_id[]">
                                            <option value="">Select  Unit</option>
                                            @foreach($units as $unit)
                                                <option value="{{$unit->id}}">{{$unit->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <input type="text" class="vat form-control"  name="vat[]" onkeyup="discountAmount('')" value="0" >
                                </td>
                                <td>
                                    <input type="text" class="amount form-control" name="sub_total[]">
                                </td>
                            </tr>

                            </tbody>

                            <tfoot>
                            <tr>
                                <th>&nbsp;</th>
                                <th colspan="2">
                                    Total:
                                    <input type="hidden" id="store_total_amount" class="form-control">
                                    <input type="text" id="total_amount" class="form-control" name="total_amount">
                                </th>
                                <th colspan="2">
                                    Paid Amount:
                                    <input type="text" id="paid_amount" class="getmoney form-control" name="paid_amount" onkeyup="paidAmount('')" value="0">
                                </th>
                                <th colspan="2">
                                    Due Amount:
                                    <input type="text" id="due_amount" class="backmoney form-control" name="due_amount">
                                </th>
                            </tr>
                            </tfoot>
                        </table>
                            <div class="form-group row">
                                <label class="control-label col-md-3"></label>
                                <div class="col-md-8">
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Service Sale</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tile-footer">
                </div>
            </div>
        </div>
    </main>

@endsection

@push('js')
    <script>
        function totalAmount(){
            var t = 0;
            $('.amount').each(function(i,e){
                var amt = $(this).val()-0;
                t += amt;
            });
            $('#store_total_amount').val(t);
            $('#total_amount').val(t);
            $('#due_amount').val(t);
        }

        // onkeyup
        function discountAmount(){
            var discount_type = $('#discount_type').val();

            var store_total_amount = $('#store_total_amount').val();
            console.log('store_total_amount= ' + store_total_amount);
            console.log('store_total_amount= ' + typeof store_total_amount);
            store_total_amount = parseInt(store_total_amount);
            console.log('total= ' + typeof store_total_amount);
            console.log('final_amount= ' + final_amount);
            console.log('final_amount= ' + typeof final_amount);

            $('#total_amount').val(final_amount);
            $('#due_amount').val(final_amount);
        }

        // onkeyup
        function paidAmount(){
            console.log('okk');
            var total = $('#total_amount').val();
            console.log('total= ' + total);
            console.log('total= ' + typeof total);

            var paid_amount = $('#paid_amount').val();
            console.log('paid_amount= ' + paid_amount);
            console.log('paid_amount= ' + typeof paid_amount);

            var due = total - paid_amount;
            console.log('due= ' + due);
            console.log('due= ' + typeof due);

            $('.backmoney').val(due);
        }

        $(function () {

            $('.add').click(function () {
                var service = $('.service_id').html();
                var serviceSubCategory = $('.service_sub_category_id').html();
                var unit = $('.service_unit_id').html();
                var n = ($('.neworderbody tr').length - 0) + 1;
                var tr = '<tr><td class="no">' + n + '</td>' +
                    '<td><select class="form-control service_id select2" name="service_id[]" id="service_id_'+n+'" onchange="getval('+n+',this);" required>' + service + '</select></td>' +
                    '<td><div id="service_sub_category_id_'+n+'"><select class="form-control service_sub_category_id select2" name="service_sub_category_id[]" readonly="">' + serviceSubCategory + '</select></div></td>' +
                    '<td><input type="text" min="1" max="" class="qty form-control" name="qty[]" required></td>' +
                    '<td><input type="text" min="1" max="" class="price form-control" name="price[]" value="" required></td>' +
                    '<td><div id="service_unit_id_'+n+'"><select class="form-control service_unit_id select2" name="service_unit_id[]" readonly="">' + unit + '</select></div></td>' +
                    '<td><input type="text" class="vat form-control" name="vat[]" required></td>' +
                    '<td><input type="text" class="amount form-control" name="sub_total[]" required></td>' +
                    '<td><input type="button" class="btn btn-danger delete" value="x"></td></tr>';

                $('.neworderbody').append(tr);

                //initSelect2();

                $('.select2').select2();

            });
            $('.neworderbody').delegate('.delete', 'click', function () {
                $(this).parent().parent().remove();
                totalAmount();
            });

            // $('.neworderbody').delegate('.qty, .price', 'keyup', function () {
            //     var tr = $(this).parent().parent();
            //     var qty = tr.find('.qty').val() - 0;
            //     var price = tr.find('.price').val() - 0;
            //     // var vat = tr.find('.vat').val() - 0;
            //     // var totalPrice =( price+vat)
            //
            //     var total = (qty * price);
            //
            //
            //     tr.find('.amount').val(total);
            //     totalAmount();
            // });
            $('.neworderbody').delegate('.qty, .price , .vat', 'keyup', function () {
                var tr = $(this).parent().parent();
                var qty = tr.find('.qty').val() - 0;
                var price = tr.find('.price').val() - 0;
                var vat = tr.find('.vat').val() - 0;

                var total = ((qty * price)+vat);

                tr.find('.amount').val(total);
                totalAmount();
                totalAmount();
            });

            $('#hideshow').on('click', function(event) {
                $('#content').removeClass('hidden');
                $('#content').addClass('show');
                $('#content').toggle('show');
            });



        });

        // ajax
        function getval(row,sel)
        {
            //alert(row);
            //alert(sel.value);
            var current_row = row;
            var current_service_id = sel.value;

            $.ajax({
                url : "{{URL('service-relation-data')}}",
                method : "get",
                data : {
                    current_service_id : current_service_id,
                },
                success : function (res){
                    //console.log(res)
                    console.log(res.data)
                    console.log(res.data.subCategoryOptions)
                    $("#service_sub_category_id_"+current_row).html(res.data.subCategoryOptions);
                    $("#service_unit_id_"+current_row).html(res.data.unitOptions);
                },
                error : function (err){
                    console.log(err)
                }
            })
        }

        $(function() {
            $('#check_number').hide();
            $('#payment_type').change(function(){
                if($('#payment_type').val() == 'check') {
                    $('#check_number').show();
                } else {
                    $('#check_number').val('');
                    $('#check_number').hide();
                }
            });
        });
    </script>
    @endpush


