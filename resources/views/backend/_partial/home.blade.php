@extends('backend._partial.dashboard')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="">Dashboard</a></li>
            </ul>

        </div>
        <div class="row">
{{--            @if(Auth::User()->getRoleNames()[0] == "Admin")--}}
{{--                @if(!empty($stores))--}}
{{--                    @foreach($stores as $store)--}}
{{--                        <div class="col-md-12">--}}
{{--                            <h1 class="text-center">{{$store->name}}</h1>--}}
{{--                        </div>--}}

{{--                        @php--}}
{{--                            $sum_purchase_price = 0;--}}
{{--                            $sum_sale_price = 0;--}}
{{--                            $sum_sale_return_price = 0;--}}
{{--                            $sum_production_price = 0;--}}
{{--                            $sum_loss_or_profit = 0;--}}

{{--                            $productPurchaseDetails = DB::table('product_purchase_details')--}}
{{--                                ->join('product_purchases','product_purchases.id','=','product_purchase_details.product_purchase_id')--}}
{{--                                ->select('product_id','product_category_id','product_sub_category_id','product_brand_id', DB::raw('SUM(qty) as qty'), DB::raw('SUM(price) as price'), DB::raw('SUM(sub_total) as sub_total'))--}}
{{--                                ->where('product_purchases.store_id',$store->id)--}}
{{--                                ->groupBy('product_id')--}}
{{--                                ->groupBy('product_category_id')--}}
{{--                                ->groupBy('product_sub_category_id')--}}
{{--                                ->groupBy('product_brand_id')--}}
{{--                                ->get();--}}

{{--                            if(!empty($productPurchaseDetails)){--}}
{{--                                foreach($productPurchaseDetails as $key => $productPurchaseDetail){--}}
{{--                                    $purchase_average_price = $productPurchaseDetail->sub_total/$productPurchaseDetail->qty;--}}
{{--                                    $sum_purchase_price += $productPurchaseDetail->sub_total;--}}

{{--                                    // sale--}}
{{--                                    $productSaleDetails = DB::table('product_sale_details')--}}
{{--                                        ->select('product_id','product_category_id','product_sub_category_id','product_brand_id', DB::raw('SUM(qty) as qty'), DB::raw('SUM(price) as price'), DB::raw('SUM(sub_total) as sub_total'))--}}
{{--                                        ->where('product_id',$productPurchaseDetail->product_id)--}}
{{--                                        ->where('product_category_id',$productPurchaseDetail->product_category_id)--}}
{{--                                        ->where('product_sub_category_id',$productPurchaseDetail->product_sub_category_id)--}}
{{--                                        ->where('product_brand_id',$productPurchaseDetail->product_brand_id)--}}
{{--                                        ->groupBy('product_id')--}}
{{--                                        ->groupBy('product_category_id')--}}
{{--                                        ->groupBy('product_sub_category_id')--}}
{{--                                        ->groupBy('product_brand_id')--}}
{{--                                        ->first();--}}

{{--                                    if(!empty($productSaleDetails))--}}
{{--                                    {--}}
{{--                                        $sale_total_qty = $productSaleDetails->qty;--}}
{{--                                        $sum_sale_price += $productSaleDetails->sub_total;--}}
{{--                                        $sale_average_price = $productSaleDetails->sub_total/$productSaleDetails->qty;--}}

{{--                                        if($sale_total_qty > 0){--}}
{{--                                            $loss_or_profit = ($sale_average_price*$sale_total_qty) - ($purchase_average_price*$sale_total_qty);--}}
{{--                                            $sum_loss_or_profit += $loss_or_profit;--}}
{{--                                        }--}}
{{--                                    }--}}

{{--                                    // sale return--}}
{{--                                    $productSaleReturnDetails = DB::table('product_sale_return_details')--}}
{{--                                        ->select('product_id','product_category_id','product_sub_category_id','product_brand_id', DB::raw('SUM(qty) as qty'), DB::raw('SUM(price) as price'))--}}
{{--                                        ->where('product_id',$productPurchaseDetail->product_id)--}}
{{--                                        ->where('product_category_id',$productPurchaseDetail->product_category_id)--}}
{{--                                        ->where('product_sub_category_id',$productPurchaseDetail->product_sub_category_id)--}}
{{--                                        ->where('product_brand_id',$productPurchaseDetail->product_brand_id)--}}
{{--                                        ->groupBy('product_id')--}}
{{--                                        ->groupBy('product_category_id')--}}
{{--                                        ->groupBy('product_sub_category_id')--}}
{{--                                        ->groupBy('product_brand_id')--}}
{{--                                        ->first();--}}

{{--                                    if(!empty($productSaleReturnDetails))--}}
{{--                                    {--}}
{{--                                        $sale_return_total_qty = $productSaleReturnDetails->qty;--}}
{{--                                        $sale_return_total_amount = $productSaleReturnDetails->price;--}}
{{--                                        $sum_sale_return_price += $productSaleReturnDetails->price;--}}
{{--                                        $sale_return_average_price = $sale_return_total_amount/$productSaleReturnDetails->qty;--}}

{{--                                        if($sale_return_total_qty > 0){--}}
{{--                                            $loss_or_profit = $sale_return_average_price - ($purchase_average_price*$sale_return_total_qty);--}}
{{--                                            $sum_loss_or_profit -= $loss_or_profit;--}}
{{--                                        }--}}
{{--                                    }--}}

{{--                                    // product production--}}
{{--                                    $productProductionDetails = DB::table('product_production_details')--}}
{{--                                        ->select('product_id','product_category_id','product_sub_category_id','product_brand_id', DB::raw('SUM(qty) as qty'), DB::raw('SUM(price) as price'), DB::raw('SUM(sub_total) as sub_total'))--}}
{{--                                        ->where('product_id',$productPurchaseDetail->product_id)--}}
{{--                                        ->where('product_category_id',$productPurchaseDetail->product_category_id)--}}
{{--                                        ->where('product_sub_category_id',$productPurchaseDetail->product_sub_category_id)--}}
{{--                                        ->where('product_brand_id',$productPurchaseDetail->product_brand_id)--}}
{{--                                        ->groupBy('product_id')--}}
{{--                                        ->groupBy('product_category_id')--}}
{{--                                        ->groupBy('product_sub_category_id')--}}
{{--                                        ->groupBy('product_brand_id')--}}
{{--                                        ->first();--}}

{{--                                    if(!empty($productProductionDetails))--}}
{{--                                    {--}}
{{--                                        $production_total_qty = $productProductionDetails->qty;--}}
{{--                                        $sum_production_price += $productProductionDetails->sub_total;--}}
{{--                                        $production_average_price = $productProductionDetails->sub_total/$productProductionDetails->qty;--}}

{{--                                        if($production_total_qty > 0){--}}
{{--                                            $loss_or_profit = ($production_average_price*$production_total_qty) - ($purchase_average_price*$production_total_qty);--}}
{{--                                            $sum_loss_or_profit += $loss_or_profit;--}}
{{--                                        }--}}
{{--                                    }--}}
{{--                                }--}}
{{--                            }--}}

{{--                        $total_expense = \App\Transaction::where('store_id',$store->id)->where('transaction_type','expense')->sum('amount');--}}
{{--                        $final_loss_or_profit = $sum_loss_or_profit - $total_expense;--}}
{{--                        @endphp--}}

{{--                        <div class="col-md-3 ">--}}
{{--                            <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>--}}
{{--                                <div class="info">--}}
{{--                                    <h4>Total Purchase</h4>--}}
{{--                                    <p><b>{{number_format($sum_purchase_price, 2, '.', '')}}</b></p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-3">--}}
{{--                            <div class="widget-small danger coloured-icon"><i class="icon fas fa-money-check-alt "></i>--}}
{{--                                <div class="info">--}}
{{--                                    <h4>Total Sell</h4>--}}
{{--                                    <p><b>{{number_format($sum_sale_price, 2, '.', '')}}</b></p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-3">--}}
{{--                            <div class="widget-small info coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>--}}
{{--                                <div class="info">--}}
{{--                                    <h4>Total Sell Return</h4>--}}
{{--                                    <p><b>{{number_format($sum_sale_return_price, 2, '.', '')}}</b></p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-3 ">--}}
{{--                            <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>--}}
{{--                                <div class="info">--}}
{{--                                    <h4>Total Production</h4>--}}
{{--                                    <p><b>{{number_format($sum_production_price, 2, '.', '')}}</b></p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-3">--}}
{{--                            <div class="widget-small warning coloured-icon"><i class="icon fas fa-file-invoice-dollar"></i>--}}
{{--                                <div class="info">--}}
{{--                                    <h4>Total Expense</h4>--}}
{{--                                    <p><b>{{number_format($total_expense, 2, '.', '')}}</b></p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-3">--}}
{{--                            <div class="widget-small info coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>--}}
{{--                                <div class="info">--}}
{{--                                    <h4>Final Loss/Profit</h4>--}}
{{--                                    <p><b>{{number_format($final_loss_or_profit, 2, '.', '')}}</b></p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        --}}{{--<div class="col-md-3">--}}
{{--                            <div class="widget-small info coloured-icon"><i class="icon fas fa-file-invoice"></i> <div class="info">--}}
{{--                                    <h4>Today Invoice</h4>--}}
{{--                                    <p><b></b></p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-3">--}}
{{--                            <div class="widget-small info coloured-icon"><i class="icon fas fa-file-invoice"></i> <div class="info">--}}
{{--                                    <h4>Today Invoice</h4>--}}
{{--                                    <p><b></b></p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-3">--}}
{{--                            <div class="widget-small info coloured-icon"><i class="icon fas fa-file-invoice"></i> <div class="info">--}}
{{--                                    <h4>Today Invoice</h4>--}}
{{--                                    <p><b></b></p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                @endif--}}
{{--        </div>--}}
{{--        @else--}}
{{--            <h1>--}}
{{--                Only Admin can show At a Glance! User can only Sale permission.--}}
{{--                <a href="{!! route('productSales.create') !!}" class="btn btn-sm btn-primary" type="button">Add Product Sales</a>--}}
{{--            </h1>--}}
{{--        @endif--}}
    </main>
@endsection


@section('footer')

@endsection
