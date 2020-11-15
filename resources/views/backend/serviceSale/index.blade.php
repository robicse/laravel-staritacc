@extends('backend._partial.dashboard')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class=""></i> All Service Sale </h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"> <a href="{!! route('serviceSale.create') !!}" class="btn btn-sm btn-primary" type="button">Add Service Sale </a></li>
            </ul>
        </div>
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Service Sale Table</h3>
                 <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th width="5%">#Id</th>
                        <th>Customer Name</th>
                        <th>Date</th>
                        <th>Payment Type</th>
                        <th>Total Amount</th>
                        <th>Paid Amount</th>
                        <th>Due Amount</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($serviceSales as $key => $serviceSale)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $serviceSale->customer->name}}</td>
                        <td>{{ $serviceSale->date}}</td>
                        <td>{{ $serviceSale->payment_type}}</td>
                        <td>{{ $serviceSale->total_amount}}</td>
                        <td>{{ $serviceSale->paid_amount}}</td>
{{--                        <td>{{ $serviceSale->due->current_due}}</td>--}}
{{--                        @dd( $serviceSale->due->current_due);--}}
{{--@dd($serviceSaleDetail->service->name);--}}
                        <td>
                            <a href="{{ route('serviceSale.show',$serviceSale->id) }}" class="btn btn-sm btn-primary float-left" >show</a>
                            <a href="{{ route('serviceSale.edit',$serviceSale->id) }}" class="btn btn-sm btn-primary float-left" style="margin-left: 5px"><i class="fa fa-edit"></i></a>
                            <form method="post" action="{{ route('serviceSale.destroy',$serviceSale->id) }}" >
                               @method('DELETE')
                                @csrf
                                <button style="margin-top: 5px" class="btn btn-sm btn-danger" type="submit" onclick="return confirm('You Are Sure This Delete !')"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="tile-footer">
                </div>
{{--                {{ $parties->links() }}--}}
            </div>

        </div>
    </main>
@endsection


