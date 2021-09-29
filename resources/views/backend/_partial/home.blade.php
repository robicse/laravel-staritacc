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
            <div class="col-md-6 col-lg-4">
                <div class="widget-small danger coloured-icon" ><i class="icon fas fa-money-check-alt "></i>
                    <div class="info">
                        <h4><a href="{!! URL::to('/account/cashbook') !!}">Cash Book</a></h4>

                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="widget-small danger coloured-icon"><i class="icon fas fa-money-check-alt "></i>
                    <div class="info">
                        <h4><a href="{!! URL::to('/account/bankbook/generalledger') !!}">Bank Book</a></h4>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection


@section('footer')

@endsection
