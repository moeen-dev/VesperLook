@extends('layouts.backend');
@section('title', 'All Products')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Table</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ Route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Product</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Product</h2>
            <p class="section-lead">All of your Product here</p>

            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <a href="{{ route('products.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Product</a>

                            <form action="{{ route('products.index') }}" method="GET" class="form-inline float-right">
                                <input type="text" name="search" class="form-control mr-2" placeholder="Search by Product SKU" value="{{ request('search') }}" required>
                                <button type="submit" class="btn btn-success">Search</button>
                            </form>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Product SKU</th>
                                            <th scope="col">Product Price</th>
                                            <th scope="col">Stock Status</th>
                                            <th scope="col">Stock Quantity</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($products->count() > 0)
                                        @foreach($products as $product)
                                        <tr>
                                            <th scope="row">{{ $loop->index + 1 }}</th>
                                            <td>{{ $product->title }}</td>
                                            <td>{{ $product->sku }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>
                                                @if($product->quantity > 0)
                                                <span class="badge badge-success">In Stock</span>
                                                @else
                                                <span class="badge badge-danger">Out of Stock</span>
                                                @endif
                                            </td>
                                            <td>{{ $product->quantity }}</td>
                                            <td class="d-flex justify-content-center align-items-center" style="gap: 10px;">
                                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info" data-toggle="tooltip" title="Edit this Product"><i class="far fa-edit"></i> Edit</a>
                                                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button data-toggle="tooltip" title="Delete this Product" class="btn btn-danger" type="submit" onclick="return confirm('Do you want to delete it?')"><i class="fas fa-times"></i> Delete</button>
                                                </form>
                                            </td>

                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="7" class="text-center text-danger">
                                                <p>No Data Found!</p>
                                                <a href="{{ route('products.create')}}" class="btn btn-primary">Create a new one</a>
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <nav class="d-inline-block">
                                {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection