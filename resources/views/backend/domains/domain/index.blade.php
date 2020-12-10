@extends('backend._partial.dashboard')

@section('content')
    <main class="app-content">
        <div class="app-title" style="margin-top: 0px">
            <div>
                <h1><i class=""></i> All Domain </h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"> <a href="{!! route('domain.create') !!}" class="btn btn-sm btn-primary" type="button">Add Domain </a></li>
            </ul>
        </div>
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Domain Table</h3>
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th width="5%">#Id</th>
                        <th width="10%">Client Name</th>
                        <th width="10%">Domain Name</th>
                        <th width="10%">Code No</th>
                        <th width="10%">Amount</th>
                        <th width="10%">Expired Date</th>
                        <th width="15%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($domains as $key => $domain)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $domain->client_name}}</td>
                            <td>{{ $domain->domain_name}}</td>
                            <td>{{ $domain->code_no}}</td>
                            <td>{{ $domain->amount}}</td>
                            <td>{{ $domain->expire_date}}</td>
                            <td>
                                <a href="{{ route('domain.edit',$domain->id) }}" class="btn btn-sm btn-primary float-left"><i class="fa fa-edit"></i></a>
                                <form method="post" action="{{ route('domain.destroy',$domain->id) }}" >
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


