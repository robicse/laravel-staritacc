@extends('backend._partial.dashboard')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class=""></i> All Expense Category</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"> <a href="{!! route('expenseCategory.create') !!}" class="btn btn-sm btn-primary" type="button">Add Expense Category</a></li>
            </ul>
        </div>
        <div class="col-md-12">
            <div class="tile">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th width="5%">#Id</th>
                        <th width="10%">Name</th>
                        <th width="15%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($expenses as $key => $expenses)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $expenses->name}}</td>
                        <td>
                            <a href="{{ route('expenseCategory.edit',$expenses->id) }}" class="btn btn-sm btn-primary float-left" style="margin-left: 5px"><i class="fa fa-edit"></i></a>
                            <form method="post" action="{{ route('expenseCategory.destroy',$expenses->id) }}" >
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
{{--                {{ $expenses->links() }}--}}
            </div>

        </div>
    </main>
@endsection


