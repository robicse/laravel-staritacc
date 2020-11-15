@extends('backend._partial.dashboard')

@section('content')
    <main class="app-content">
        <div class="app-title" style="margin-top: 0px">
            <div>
                <h1><i class=""></i> All Service Category</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"> <a href="{!! route('serviceCategory.create') !!}" class="btn btn-sm btn-primary" type="button">Add Service Category</a></li>
            </ul>
        </div>
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Service Category Table</h3>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th width="5%">#Id</th>
                        <th width="10%">Service Category Name</th>
                        <th width="15%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $key => $category)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $category->name}}</td>
                            <td>
                                <a href="{{ route('serviceCategory.edit',$category->id) }}" class="btn btn-sm btn-primary float-left"><i class="fa fa-edit"></i></a>
                                <form method="post" action="{{ route('serviceCategory.destroy',$category->id) }}" >
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
                {{ $categories->links() }}
            </div>

        </div>
    </main>
@endsection


