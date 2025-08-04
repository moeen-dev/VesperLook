@extends('layouts.backend')
@section('title', 'Create Banner')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Table</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ Route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Banner Create</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Create Banner</h2>
            <p class="section-lead">Create your banner from here</p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Upload Your Banner Image and Click on Save.</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('banner.store') }}" method="POST" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Banner Image (1920*844 | Max: 2MB) <span class="text-danger">*</span></label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="file" class="form-image" name="image" id="image">
                                        @if($errors->has('image'))
                                        <small style="color: red">{{ $errors->first('image')}}</small>
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