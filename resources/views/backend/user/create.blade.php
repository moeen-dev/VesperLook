@extends('layouts.backend')
@section('title', 'Create User')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Table</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ Route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">User</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Create an user</h2>
            <p class="section-lead">Create your user from here</p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Fill this form and Click on Save.</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('users.store') }}" method="POST" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name <span class="text-danger">*</span></label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control" name="name" id="name" required>
                                        @if($errors->has('name'))
                                        <small style="color: red">{{ $errors->first('name')}}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Eamil <span class="text-danger">*</span></label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="email" class="form-control" name="email" id="email" autocomplete="off" required>
                                        @if($errors->has('email'))
                                        <small style="color: red">{{ $errors->first('email')}}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password <span class="text-danger">*</span></label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="password" class="form-control" name="password" id="password" autocomplete="new-password" required>
                                        @if($errors->has('password'))
                                        <small style="color: red">{{ $errors->first('password')}}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Role <span class="text-danger">*</span></label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control" name="is_admin" id="is_admin" required>
                                            <option value="0">User</option>
                                            <option value="1">Admin</option>
                                        </select>
                                        @if($errors->has('is_admin'))
                                        <small style="color: red">{{ $errors->first('is_admin') }}</small>
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