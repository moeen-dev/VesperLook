@extends('layouts.backend')
@section('title', 'Edit SubCategory')
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
            <h2 class="section-title">Edit Sub-Category</h2>
            <p class="section-lead">Edit your Sub Category from here</p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Fill this form and Click on Save.</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('sub-category.update', $subcategory->id) }}" method="POST" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Sub Categoty Title <span class="text-danger">*</span></label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control" name="subcategory_name" id="subcategory_name" value="{{ $subcategory->subcategory_name }}">
                                        @if($errors->has('subcategory_name'))
                                        <small style="color: red">{{ $errors->first('subcategory_name')}}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Sub Categoty Slug</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control" name="slug" id="slug" value="{{ $subcategory->slug }}">
                                        @if($errors->has('slug'))
                                        <small style="color: red">{{ $errors->first('slug')}}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Select Category <span class="text-danger">*</span></label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control selectric" name="category_id" id="category_id">
                                            <option selected disabled>Please Select a Category</option>
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $subcategory->category_id == $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Category Image (900*500 | Max: 2MB) <span class="text-danger">*</span></label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="file" class="form-image" name="image" id="image" data-default-file="{{ url('upload/images', $subcategory->image) }}">
                                        @if($errors->has('image'))
                                        <small style="color: red">{{ $errors->first('image')}}</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-primary">Update</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection
@section('scripts')
<script>
    $("#subcategory_name").keyup(function() {
        var Text = $(this).val();
        Text = Text.toLowerCase();
        Text = Text.replace(/[^a-zA-Z0-9]+/g, '-');
        $("#slug").val(Text);
    });
</script>
@endsection