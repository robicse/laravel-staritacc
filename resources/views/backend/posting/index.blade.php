@extends('backend._partial.dashboard')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class=""></i> All Posting </h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"> <a href="{!! route('transaction.create') !!}" class="btn btn-sm btn-primary" type="button">Add Posting </a></li>
            </ul>
        </div>
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Posting Table</h3>
                 <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th width="5%">#Id</th>
                        <th>Account Name</th>
                        <th>Date</th>
{{--                        <th>Voucher Type</th>--}}
                        <th>Amount</th>
                        <th>Debit/Credit</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($transactions as $key => $transaction)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $transaction->account_name}}</td>
                        <td>{{ $transaction->date}}</td>

                        <td>{{ $transaction->debit == Null ? $transaction->credit : $transaction->debit }}</td>
                        <td>{{ $transaction->debit == Null ? 'credit' : 'debit'}}</td>
                        <td>
                            <a href="{{ url('account/voucher-invoice/'.$transaction->voucher_no.'/'.$transaction->date) }}" class="btn btn-sm btn-primary float-left" >print</a>
                            <a href="{{ route('transaction.edit',$transaction->id) }}" class="btn btn-sm btn-primary float-left" style="margin-left: 5px"><i class="fa fa-edit"></i></a>
                            <form method="post" action="{{ route('transaction.destroy',$transaction->id) }}" >
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
{{--                {{ $parties->links() }}--}}
            </div>

        </div>
    </main>
@endsection


