@extends('layouts.backend')
@section('title', 'Create Category')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Table</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ Route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Category Create</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Create Category</h2>
            <p class="section-lead">Create your Category from here</p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Fill this form and Click on Save.</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('category.store') }}" method="POST" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Categoty Title</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control" name="category_name" id="category_name" value="{{ old('category_name') }}">
                                        @if($errors->has('category_name'))
                                        <small style="color: red">{{ $errors->first('category_name')}}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Categoty Slug</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug') }}">
                                        @if($errors->has('slug'))
                                        <small style="color: red">{{ $errors->first('slug')}}</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-primary">Save</button>
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
    $("#category_name").keyup(function() {
        var Text = $(this).val();
        Text = Text.toLowerCase();
        Text = Text.replace(/[^a-zA-Z0-9]+/g, '-');
        $("#slug").val(Text);
    });
</script>
@endsection