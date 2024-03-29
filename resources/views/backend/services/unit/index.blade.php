@extends('backend._partial.dashboard')

@section('content')
    <main class="app-content">
        <div class="app-title" style="margin-top: 0px">
            <div>
                <h1><i class=""></i> All Service Unit</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"> <a href="{!! route('serviceUnit.create') !!}" class="btn btn-sm btn-primary" type="button">Add Service Unit</a></li>
            </ul>
        </div>
        <div class="col-md-12">
            <div class="tile">
                <h3 class="title">Service Unit Table</h3>
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5%">#Id</th>
                            <th width="10%"> Name</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($units as $key => $unit)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $unit->name}}</td>
                            <td>
                                <a href="{{ route('serviceUnit.edit',$unit->id) }}" class="btn btn-sm btn-primary float-left" style="margin-left: 5px"><i class="fa fa-edit"></i></a>
                                <form method="post" action="{{ route('serviceUnit.destroy',$unit->id) }}" >
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-sm btn-danger" style="margin-left: 5px" type="submit" onclick="return confirm('You Are Sure This Delete !')"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
            </div>

        </div>
    </main>
@endsection


