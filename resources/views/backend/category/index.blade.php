@extends('layouts.backend')
@section('title', 'Create Category')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Table</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ Route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Category</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Category</h2>
            <p class="section-lead">All of your category here</p>

            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <a href="{{ route('category.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Category</a>

                            <form action="{{ route('category.index') }}" method="GET" class="form-inline float-right">
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
                                            <th scope="col">Category Name</th>
                                            <th scope="col">Category Slug</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($categories->count() > 0)
                                        @foreach($categories as $category)
                                        <tr>
                                            <th scope="row">{{ $loop->index + 1 }}</th>
                                            <td>{{ $category->category_name }}</td>
                                            <td>{{ $category->slug }}</td>
                                            <td class="d-flex justify-content-center align-items-center" style="gap: 10px;">
                                                <a href="{{ route('category.edit', $category->id) }}" class="btn btn-info" data-toggle="tooltip" title="Edit this category"><i class="far fa-edit"></i> Edit</a>
                                                <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button data-toggle="tooltip" title="Delete this category" data-target="#deleteModal"  class="btn btn-danger" type="submit" onclick="return confirm('Do you want to delete it?')"><i class="fas fa-times"></i> Delete</button>
                                                </form>
                                            </td>

                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="5" class="text-center text-danger">
                                                <p>No Data Found!</p>
                                                <a href="{{ route('category.create')}}" class="btn btn-primary">Create a new one</a>
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection