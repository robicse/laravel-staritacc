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
                <h1><i class=""></i> Add Service Sale Details</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('serviceSaleDetails.index') }}" class="btn btn-sm btn-primary col-sm" type="button">All Service Sale Details</a>
                </li>
            </ul>
        </div>
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Add Service Sale Details</h3>
                <div class="tile-body tile-footer">
                    @if(session('response'))
                        <div class="alert alert-success">
                            {{ session('response') }}
                        </div>
                    @endif
                    <form method="post" action="{{ route('serviceSaleDetails.store') }}">
                        @csrf

                        <div class="table-responsive">
                            <input type="button" class="btn btn-primary add " style="   margin-left: 960px;" value="Add More Product">
                            <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th >ID</th>
                                <th>Service <small class="requiredCustom">*</small></th>
                                <th>Qty <small class="requiredCustom">*</small></th>
                                <th>Price <small class="requiredCustom">*</small></th>
                                <th>Unit <small class="requiredCustom">*</small></th>
                                <th>Sub Total</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody class="neworderbody">
                            <tr>
                                <td width="5%" class="no">1</td>
                                <td>
                                    <select class="form-control service_id select2" name="service_id[]" id="service_id_1" onchange="getval(1,this);" required>
                                        <option value="">Select  Product</option>
                                        @foreach($services as $service)
                                            <option value="{{$service->id}}">{{$service->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" min="1" max="" class="qty form-control" name="qty[]" value="" required >
                                </td>
                                <td>
                                    <input type="number" min="1" max="" class="price form-control" name="price[]" value="" required >
                                </td>
                                <td>
                                    <input type="number" min="1" max="" class="form-control" name="unit[]" value="" required >
                                </td>
                                <td>
                                    <input type="text" class="amount form-control" name="sub_total[]">
                                </td>
                            </tr>

                            </tbody>

                            <tfoot>
                            <tr>
                                <th colspan="6">
                                </th>
                            </tr>
                            </tfoot>
                        </table>
                            <div class="form-group row">
                            <label class="control-label col-md-3"></label>
                            <div class="col-md-8">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Product Purchases</button>
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
            $('.total').html(t);
        }
        $(function () {
            $('.getmoney').change(function(){
                var total = $('.total').html();
                var getmoney = $(this).val();
                //var t = getmoney - total;
                var t = total - getmoney;
                var t_final_val = t.toFixed(2);
                $('.backmoney').val(t_final_val);
                $('.total').val(total);
            });
            $('.add').click(function () {
                var service = $('.service_id').html();
                var n = ($('.neworderbody tr').length - 0) + 1;
                var tr = '<tr><td class="no">' + n + '</td>' +
                    '<td><select class="form-control service_id select2" name="service_id[]" id="service_id_'+n+'" onchange="getval('+n+',this);" required>' + service + '</select></td>' +
                    '<td><input type="number" min="1" max="" class="qty form-control" name="qty[]" required></td>' +
                    '<td><input type="text" min="1" max="" class="price form-control" name="price[]" value="" required></td>' +
                    '<td><input type="text" min="1" max="" class="form-control" name="unit[]" value="" required></td>' +
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

            $('.neworderbody').delegate('.qty, .price', 'keyup', function () {
                var tr = $(this).parent().parent();
                var qty = tr.find('.qty').val() - 0;
                var price = tr.find('.price').val() - 0;

                var total = (qty * price);

                tr.find('.amount').val(total);
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
            var current_product_id = sel.value;

            $.ajax({
                url : "{{URL('product-relation-data')}}",
                method : "get",
                data : {
                    current_product_id : current_product_id
                },
                success : function (res){
                    //console.log(res)
                    console.log(res.data)
                    //console.log(res.data.categoryOptions)
                    $("#product_category_id_"+current_row).html(res.data.categoryOptions);
                    $("#product_sub_category_id_"+current_row).html(res.data.subCategoryOptions);
                    $("#product_brand_id_"+current_row).html(res.data.brandOptions);
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


