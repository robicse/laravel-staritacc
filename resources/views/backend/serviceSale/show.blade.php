@extends('backend._partial.dashboard')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class=""></i> Product Productions And Details</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"> <a href="{!! route('serviceSale.index') !!}" class="btn btn-sm btn-primary" type="button">Back</a></li>
            </ul>
        </div>
        <div class="col-md-12">
            <div class="tile">
                {{--                <ul class="app-breadcrumb breadcrumb">--}}
                {{--                    <li class="breadcrumb-item" style="margin-left: 88%"> <a href="{!! route('productProductions-invoice',$productProduction->id) !!}" class="btn btn-sm btn-primary"  type="button">Print Invoice Page</a></li>--}}
                {{--                </ul>--}}
                <h3 class="tile-title">Product Productions</h3>
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th>Customer Name</th>
                        <td>{{$serviceSales->customer->name}}</td>
                    </tr>
                    <tr>
                        <th>Payment Type</th>
                        <td>{{$serviceSales->payment_type}}</td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td>{{$serviceSales->date}}</td>
                    </tr>
                    <tr>
                        <th>Total Amount</th>
                        <td>{{$serviceSales->total_amount}}</td>
                    </tr>
                    <tr>
                        <th>Paid Amount</th>
                        <td>{{$serviceSales->paid_amount}}</td>
                    </tr>
                    <tr>
                        <th>Due Amount</th>
                        <td>{{$serviceSales->due_amount}}</td>
                    </tr>
                    </tbody>
                </table>
                    <div class="tile-footer">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Product Productions Details</h3>
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Service</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Unit</th>
                        <th>Sub Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($serviceSalesDetails as $key => $serviceSalesDetail)
                        <tr>
                            <td>
                                {{$serviceSalesDetail->service->name}}
                            </td>
                            <td>
                                {{$serviceSalesDetail->qty}}
                            </td>
                            <td>
                                {{$serviceSalesDetail->price}}
                            </td>
                            <td>
                                {{$serviceSalesDetail->service->serviceUnit->name}}
                            </td>
                            <td>
                                {{$serviceSalesDetail->sub_total}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>

            </div>
        </div>
    </main>
@endsection


