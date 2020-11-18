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
                <div class="widget-small danger coloured-icon" ><i class="icon fa fa-users fa-3x"></i>
                    <div class="info">
                        <h4><a href="{{route('customer.index')}}">Customers</a></h4>
                        <p><b><a href="{{route('customer.index')}}"> {{$customer}}</a></b></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="widget-small danger coloured-icon"><i class="icon fas fa-money-check-alt "></i>
                    <div class="info">
                        <h4><a href="">Dues</a></h4>
                        <p><b><a href=""> {{$due}}</a></b></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="widget-small danger coloured-icon"><i class="icon fas fa-file-invoice-dollar"></i>
                    <div class="info">
                        <h4><a href="{{route('expenses.index')}}">Total Expense</a></h4>
                        <p><b><a href="{{route('expenses.index')}}"> {{$expense}}</a></b></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="widget-small danger coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                    <div class="info">
                        <h4><a href="{{route('employee.index')}}">Total Employee</a></h4>
                        <p><b><a href="{{route('employee.index')}}"> {{$employeeList}}</a></b></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="widget-small danger coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
                    <div class="info">
                        <h4><a href="{{route('service.index')}}">Total Service</a></h4>
                        <p><b><a href="{{route('service.index')}}"> {{$service}}</a></b></p>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection


@section('footer')

@endsection
