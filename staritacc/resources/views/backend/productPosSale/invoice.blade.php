@extends('backend._partial.dashboard')
<style>
.invoice-to{
    /*width: 401px;*/
    padding: 10px;
    border: 2px solid black;
    margin: 0;
}

</style>
@section('content')
    <link rel="stylesheet" href="{{asset('backend/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('backend/dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Invoice</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Invoice</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="callout callout-info">
                                <h5><i class="fas fa-info"></i> Note:</h5>
                                This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
                            </div>


                            <!-- Main content -->
                            <div class="invoice p-3 mb-3">
                                <!-- title row -->
                                <div class="row">
                                    <div class="col-12">
                                        <h4 style="float: right">
                                            <img class="float-right" src="{{asset('uploads/store/'.$store->logo)}}" alt="logo" height="60px" width="250px"><br><br>
                                            <small class="float-right"> {{date('d-m-Y')}}</small><br>
                                            <small class="float-right">Invoice #{{$productSale->invoice_no}}</small><br>
                                        </h4>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- info row -->
                                <div class="row invoice-info">
                                    <div class="col-md-8 invoice-col">
                                        <address>
                                            <strong>Simco Main Store</strong><br>
                                            Flat # 3-B, (3rd floor)<br>
                                            Square Tower (Bashundhara Lane)<br>
                                            36/6, Mirpur Road <br><br>
                                            Dhaka-1205<br>
                                            Bangladesh

                                        </address>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-4 invoice-col">
                                        <div class="invoice-to">
                                            <table style="width:100%">

                                                <tr>
                                                    <th>Invoice</th>
                                                    <th>#{{$productSale->invoice_no}}</th>

                                                </tr>
                                                <tr>
                                                    <td>Customer Name:</td>
                                                    <td>{{$party->name}}</td>

                                                </tr>
                                                <tr>
                                                    <td>Phone NO:</td>
                                                    <td>{{$party->phone}}</td>

                                                </tr>
                                                <tr>
                                                    <td>Email:</td>
                                                    <td>{{$party->email}}</td>

                                                </tr>
                                                <tr>
                                                    <td style="text-align: left;font-size: 24px;">Creditor:</td>
                                                    <td style="text-align: left;font-size: 24px;">Test</td>
                                                </tr>
                                            </table>

                                        </div>
                                    </div>
                                    <!-- /.col -->

                                </div>
                                <!-- /.row -->

                                <!-- Table row -->
                                <div class="row">
                                    <div class="col-12 table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>SL#</th>
                                                <th>Product</th>
                                                <th>Qty</th>
                                                <th>Price</th>
                                                <th>Subtotal</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $sum_sub_total = 0;
                                            @endphp
                                            @foreach($productSaleDetails as $key => $productSaleDetail)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$productSaleDetail->product->name}}</td>
                                                <td>{{$productSaleDetail->qty}}</td>
                                                <td>{{$productSaleDetail->price}}</td>
                                                <td>
                                                    @php
                                                        $sub_total=$productSaleDetail->qty*$productSaleDetail->price;
                                                        $sum_sub_total += $sub_total;
                                                    @endphp
                                                    {{$sub_total}}
                                                </td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <div class="row">
                                    <!-- accepted payments column -->
                                    <div class="col-6">
{{--                                        <p class="lead">Payment Methods:</p>--}}
{{--                                        <img src="{{asset('backend/dist/img/credit/visa.png')}}" alt="Visa">--}}
{{--                                        <img src="{{asset('backend/dist/img/credit/mastercard.png')}}" alt="Mastercard">--}}
{{--                                        <img src="{{asset('backend/dist/img/credit/american-express.png')}}" alt="American Express">--}}
{{--                                        <img src="{{asset('backend/dist/img/credit/paypal2.png')}}" alt="Paypal">--}}

{{--                                        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">--}}
{{--                                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem--}}
{{--                                            plugg--}}
{{--                                            dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.--}}
{{--                                        </p>--}}
                                        <p class="lead">Payment Type:</p>
                                        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                            {{$transaction->payment_type}}
                                            @if($transaction->payment_type == 'check')
                                                ( Check Number: {{$transaction->check_number}} )
                                            @endif
                                        </p>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-6">
{{--                                        <p class="lead">Amount Due 2/22/2014</p>--}}
                                        <p class="lead">Amount</p>

                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th style="width:50%">Subtotal:</th>
                                                    <td>{{$sum_sub_total}}</td>
                                                </tr>
{{--                                                <tr>--}}
{{--                                                    <th>Tax (9.3%)</th>--}}
{{--                                                    <td>$10.34</td>--}}
{{--                                                </tr>--}}
                                                <tr>
                                                    <th>Discount:</th>
                                                    <td>{{$productSale->discount_amount}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Total Amount:</th>
                                                    <td>{{$productSale->total_amount}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Paid Amount:</th>
                                                    <td>{{$productSale->paid_amount}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Due Amount:</th>
                                                    <td>{{$productSale->due_amount}}</td>
                                                </tr>
{{--                                                <tr>--}}
{{--                                                    <th>Previous Due Amount:</th>--}}
{{--                                                    <td>--}}
{{--                                                        @php--}}
{{--                                                            $product_sale_dues = \App\ProductSale::query()--}}
{{--                                                            ->select(DB::raw('SUM(due_amount) as due_amount'))--}}
{{--                                                            ->where('id','<',$productSale->id)--}}
{{--                                                            ->first();--}}

{{--                                                            $previous_due_amount = $product_sale_dues->due_amount;--}}
{{--                                                            if(!empty($previous_due_amount)){--}}
{{--                                                                echo $previous_due_amount;--}}
{{--                                                            }else{--}}
{{--                                                                echo $previous_due_amount = 0;--}}
{{--                                                            }--}}
{{--                                                        @endphp--}}
{{--                                                    </td>--}}
{{--                                                </tr>--}}
{{--                                                <tr>--}}
{{--                                                    <th>Final Due Amount:</th>--}}
{{--                                                    <td>{{$productSale->due_amount+$previous_due_amount}}</td>--}}
{{--                                                </tr>--}}
                                            </table>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                                <div class="row footer_div">
                                    <div class="col-md-4" style="width: 33%;float: left;display: inline-block">
                                        <strong>Mr. ASM Ibrahim</strong> <br>
                                        Director of Simco<br>
                                    </div>
                                    <div class="col-md-4" style="width: 33%;float: left;display: inline-block">
                                        Mob : +88-02-9662755<br>
                                        IP : +88-02-8624637<br>
                                        email : <span style="color: #0000FF">simcodhaka@gmail.com</span>
                                    </div>
                                    <div class="col-md-4" style="width: 33%;float: left;display: inline-block">
                                        <strong>Address :</strong><br>
                                        Flat # 3-B, (3rd floor) Square Tower<br/>
                                        (Bashundhara Lane) 36/6, Mirpur Road<br/>
                                        Dhaka-1205, Bangladesh.
                                    </div>
                                </div>
                                <!-- this row will not appear when printing -->
                                <div class="row no-print">
                                    <div class="col-12">
                                        <a href="{{route('product.pos.Sales-invoice-print',$productSale->id)}}" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
{{--                                        <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit--}}
{{--                                            Payment--}}
{{--                                        </button>--}}
{{--                                        <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">--}}
{{--                                            <i class="fas fa-download"></i> Generate PDF--}}
{{--                                        </button>--}}
                                    </div>
                                </div>
                            </div>
                            <!-- /.invoice -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{asset('backend/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('backend/dist/js/adminlte.min.js')}}"></script>
    <script src="{{asset('backend/dist/js/demo.js')}}"></script>

@endsection


