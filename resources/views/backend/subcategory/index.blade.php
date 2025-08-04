@extends('layouts.backend')
@section('title', 'Sub Category')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Table</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ Route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Sub Category</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Sub Category</h2>
            <p class="section-lead">All of your sub category here</p>

            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <a href="{{ route('sub-category.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Sub Category</a>

                            <form action="{{ route('sub-category.index') }}" method="GET" class="form-inline float-right">
                                <input type="text" name="search" class="form-control mr-2" placeholder="Search by name" value="{{ request('search') }}" required>
                                <button type="submit" class="btn btn-success">Search</button>
                            </form>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Category Name</th>
                                            <th scope="col">Sub Category Name</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($subcategories->count() > 0)
                                        @foreach($subcategories as $subcategory)
                                        <tr>
                                            <th scope="row">{{ $loop->index + 1 }}</th>
                                            <td>
                                                <img style="width: 100px; height: auto;" src="{{ url('upload/images', $subcategory->image ) }}" alt="sub_category_image">
                                            </td>
                                            <td>{{ $subcategory->category->category_name }}</td>
                                            <td>{{ $subcategory->subcategory_name }}</td>
                                            <td class="d-flex justify-content-center align-items-center" style="gap: 10px;">
                                                <a href="{{ route('sub-category.edit', $subcategory->id) }}" class="btn btn-info" data-toggle="tooltip" title="Edit this sub-category"><i class="far fa-edit"></i> Edit</a>
                                                <form action="{{ route('sub-category.destroy', $subcategory->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button data-toggle="tooltip" title="Delete this sub-category" class="btn btn-danger" type="submit" onclick="return confirm('Do you want to delete it?')"><i class="fas fa-times"></i> Delete</button>
                                                </form>
                                            </td>

                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="5" class="text-center text-danger">
                                                <p>No Data Found!</p>
                                                <a href="{{ route('sub-category.create')}}" class="btn btn-primary">Create a new one</a>
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <nav class="d-inline-block">
                                {{ $subcategories->withQueryString()->links('pagination::bootstrap-5') }}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection