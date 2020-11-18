@extends('backend._partial.dashboard')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class=""></i> All Service Sale Details</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"> <a href="{!! route('serviceSaleDetails.create') !!}" class="btn btn-sm btn-primary" type="button">Add Service Sale Details</a></li>
            </ul>
        </div>
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Service Sale Details Table</h3>
                 <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th width="5%">#Id</th>
                        <th>Service Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($serviceSaleDetails as $key => $serviceSaleDetail)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $serviceSaleDetail->service->name}}</td>
{{--@dd($serviceSaleDetail->service->name);--}}
                        <td>
                            <a href="{{ route('serviceSaleDetails.edit',$serviceSaleDetail->id) }}" class="btn btn-sm btn-primary float-left"><i class="fa fa-edit"></i></a>
                            <form method="post" action="{{ route('serviceSaleDetails.destroy',$serviceSaleDetail->id) }}" >
                               @method('DELETE')
                                @csrf
                                <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('You Are Sure This Delete !')"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="tile-footer">
                </div>
            </div>

        </div>
    </main>
@endsection


