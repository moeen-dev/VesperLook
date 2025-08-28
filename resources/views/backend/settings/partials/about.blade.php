@extends('layouts.backend')
@section('title', 'Edit General Info')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Product Management</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Create Product</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Fill in the details and click Save.</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.setting.about.update') }}" method="POST" class="needs-validation"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Product
                                        Description</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea class="form-control summernote" name="about_desc"
                                            rows="5">{{ old('about_desc', $about->about_desc ?? '') }}</textarea>
                                        @if($errors->has('about_desc'))
                                        <small class="text-danger">{{ $errors->first('about_desc') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button type="submit" class="btn btn-primary">Update</button>
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