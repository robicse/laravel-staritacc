@extends('backend._partial.dashboard')

@section('content')
    <main class="app-content">
        <div class="app-title" style="margin-top: 0px">
            <div>
                <h1><i class=""></i> All Domain Renew </h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"> <a href="{!! route('domain-renew.create') !!}" class="btn btn-sm btn-primary" type="button">Add Domain Renew </a></li>
            </ul>
        </div>
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Domain-Renew Table</h3>
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th width="5%">#Id</th>
                        <th width="10%">Code No</th>
                        <th width="10%">Amount</th>
                        <th width="10%">Renew Date</th>
                        <th width="10%">Expire Date</th>
                        <th width="10%">Remarks</th>
                        <th width="15%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($domain_renews as $key => $domain_renew)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $domain_renew->domain->code_no}}</td>
                            <td>{{ $domain_renew->domain->amount}}</td>
                            <td>{{ $domain_renew->renew_date}}</td>
                            <td>{{ $domain_renew->expired_date}}</td>
                            <td>{{ $domain_renew->remarks}}</td>
                            <td>
                                <a href="{{ route('domain-renew.edit',$domain_renew->id) }}" class="btn btn-sm btn-primary float-left" style="margin-left: 5px"><i class="fa fa-edit"></i></a>
                                <form method="post" action="{{ route('domain-renew.destroy',$domain_renew->id) }}" >
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-sm btn-danger" style="margin-left: 5px" type="submit" onclick="return confirm('You Are Sure This Delete !')"><i class="fa fa-trash"></i></button>
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


