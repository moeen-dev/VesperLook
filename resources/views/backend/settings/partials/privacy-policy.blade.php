@extends('layouts.backend')
@section('title', 'Edit Privacy Policy')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Privacy Policy</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Create or Update Order Return Policy</div>
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
                                <form action="{{ route('admin.setting.privacy.policy.update') }}" method="POST"
                                    class="needs-validation" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Privacy
                                            Policy</label>
                                        <div class="col-sm-12 col-md-7">
                                            <textarea class="form-control summernote" name="privacy_policy" rows="5">{{ old('privacy_policy', $privacyPolicy->privacy_policy ?? '') }}</textarea>
                                            @if ($errors->has('privacy_policy'))
                                                <small class="text-danger">{{ $errors->first('privacy_policy') }}</small>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                        <div class="col-sm-12 col-md-7">
                                            <button type="submit" class="btn btn-primary">Update Privacy Policy</button>
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
