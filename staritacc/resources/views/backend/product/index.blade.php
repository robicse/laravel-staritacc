@extends('backend._partial.dashboard')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class=""></i> All Product</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"> <a href="{!! route('products.create') !!}" class="btn btn-sm btn-primary" type="button">Add Product</a></li>
            </ul>
        </div>
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Product Table</h3>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th width="5%">#Id</th>
                        <th width="10%">Product Type</th>
                        <th width="10%">Barcode</th>
                        <th width="10%">Product Name</th>
                        <th width="10%">Category Name</th>
                        <th width="10%">Sub Category Name</th>
                        <th width="10%">Brand Name</th>
                        <th width="10%">Image</th>
                        <th width="15%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $key => $product)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $product->product_type}}</td>
                            <td>{{ $product->barcode}}</td>
                            <td>{{ $product->name}}</td>
                            <td>{{ $product->product_category->name}}</td>
                            <td>{{ $product->product_sub_category ? $product->product_sub_category->name : ''}}</td>
                            <td>{{ $product->product_brand->name}}</td>
                            <td> <img src="{{asset('uploads/product/'.$product->image)}}" alt="" width="100px;"></td>
                            <td>
                                <a href="{{ route('products.edit',$product->id) }}" class="btn btn-sm btn-primary float-left"><i class="fa fa-edit"></i></a>
                                <form method="post" action="{{ route('products.destroy',$product->id) }}" >
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
                {{ $products->links() }}
            </div>

        </div>
    </main>
@endsection


