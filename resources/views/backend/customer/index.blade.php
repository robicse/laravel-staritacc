@extends('backend._partial.dashboard')

@section('content')
    <main class="app-content">
        <div class="app-title" style="margin-top: 0px">
            <div>
                <h1><i class=""></i> All Customers1 </h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"> <a href="{!! route('customer.create') !!}" class="btn btn-sm btn-primary" type="button">Add Customers </a></li>
            </ul>
        </div>
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Customers Table</h3>
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th width="5%">#Id</th>
                        <th width="10%">Company Name</th>
                        <th width="10%">Email</th>
                        <th width="10%">Phone</th>
                        <th width="10%">Address</th>
                        <th width="15%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($custmers as $key => $custmer)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $custmer->name}}</td>
                            <td>{{ $custmer->email}}</td>
                            <td>{{ $custmer->phone}}</td>
                            <td>{{ $custmer->address}}</td>
                            <td>
                                <a href="{{ route('customer.edit',$custmer->id) }}" class="btn btn-sm btn-primary float-left"><i class="fa fa-edit"></i></a>
                                <form method="post" action="{{ route('customer.destroy',$custmer->id) }}" >
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

        </div>
    </main>
@endsection


