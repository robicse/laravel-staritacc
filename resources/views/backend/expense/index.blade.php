@extends('backend._partial.dashboard')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class=""></i> All Expenses</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"> <a href="{!! route('expenses.create') !!}" class="btn btn-sm btn-primary" type="button">Add Expenses</a></li>
            </ul>
        </div>
        <div class="col-md-12">
            <div class="tile">

                <h3 class="tile-title">Expenses Table</h3>
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th width="5%">#Id</th>
                        <th>Expense Category</th>
                        <th>Payment Type</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($expenses as $key => $expense)
                    <tr>
                        <td>{{ $key+1 }}</td>
{{--                        @dd($expense->expenseCategory);--}}
                        <td>{{ $expense->expenseCategory->name}}</td>

                        <td>
                            {{ $expense->payment_type}}
                            @if($expense->payment_type == 'check')
                                ({{ $expense->check_number}})
                            @endif
                        </td>
                        <td>{{ $expense->amount}}</td>
                        <td>{{ $expense->date}}</td>
                        <td>
{{--                            <a href="{{ route('expenses.show',$expense->id) }}" class="btn btn-sm btn-info float-left">Show</a>--}}
                            <a href="{{ route('expenses.edit',$expense->id) }}" class="btn btn-sm btn-primary float-left"><i class="fa fa-edit"></i></a>
                            <form method="post" action="{{ route('expenses.destroy',$expense->id) }}" >
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


