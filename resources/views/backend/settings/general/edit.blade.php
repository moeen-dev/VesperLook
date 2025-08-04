@extends('layouts.backend')
@section('title', 'Create SEO')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>General Settings</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Edit General Info</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title"> General Info settings</h2>
            <p class="section-lead">Edit General Info settings</p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('admin.setting.general.index') }}" class="btn btn-primary"><i
                                    class="fa fa-list"></i> General Info settings</a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.setting.general.edit') }}" method="POST" class="needs-validation"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-row">
                                    <div class="form-group col-md-6 col-lg-6">
                                        <label>Phone Number</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-phone"></i>
                                                </div>
                                            </div>
                                            <input type="phone" name="phone_number" id="phone_number" value="{{ old('phone_number', $setting->phone_number ?? '') }}" class="form-control @error('phone_number') is-invalid @enderror"">
                                            
                                        </div>
                                        @if($errors->has('phone_number'))
                                        <small class="text-danger">{{ $errors->first('phone_number') }}</small>
                                        @endif
                                    </div>
                                
                                    <div class="form-group col-md-6 col-lg-6">
                                        <label>Contact Mail</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-envelope"></i>
                                                </div>
                                            </div>
                                            <input type="email" name="email" id="email" value="{{ old('email', $setting->email ?? '') }}" class="form-control @error('email') is-invalid @enderror"">
                                            
                                        </div>
                                        @if($errors->has('email'))
                                        <small class="text-danger">{{ $errors->first('email') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6 col-lg-3">
                                        <label>Facebook URL</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                   <i class="fab fa-facebook-f"></i>
                                                </div>
                                            </div>
                                            <input type="link" name="facebook_url" id="facebook_url" value="{{ old('facebook_url', $setting->facebook_url ?? '') }}" class="form-control @error('facebook_url') is-invalid @enderror"">
                                            
                                        </div>
                                        @if($errors->has('facebook_url'))
                                        <small class="text-danger">{{ $errors->first('facebook_url') }}</small>
                                        @endif
                                    </div>
                                
                                    <div class="form-group col-md-6 col-lg-3">
                                        <label>Instagram URL</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fab fa-instagram"></i>
                                                </div>
                                            </div> 
                                            <input type="link" name="instagram_url" id="instagram_url" value="{{ old('instagram_url', $setting->instagram_url ?? '') }}" class="form-control @error('instagram_url') is-invalid @enderror"">
                                            
                                        </div>
                                        @if($errors->has('instagram_url'))
                                        <small class="text-danger">{{ $errors->first('instagram_url') }}</small>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6 col-lg-3">
                                        <label>Linkedin URL</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fab fa-linkedin-in"></i>
                                                </div>
                                            </div>
                                            <input type="link" name="linkedin_url" id="linkedin_url" value="{{ old('linkedin_url', $setting->linkedin_url ?? '') }}" class="form-control @error('linkedin_url') is-invalid @enderror"">
                                            
                                        </div>
                                        @if($errors->has('linkedin_url'))
                                        <small class="text-danger">{{ $errors->first('linkedin_url') }}</small>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6 col-lg-3">
                                        <label>Pinterest URL</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                   <i class="fab fa-pinterest-p"></i>
                                                </div>
                                            </div>
                                            <input type="link" name="pinterest_url" id="pinterest_url" value="{{ old('pinterest_url', $setting->pinterest_url ?? '') }}" class="form-control @error('pinterest_url') is-invalid @enderror"">
                                            
                                        </div>
                                        @if($errors->has('pinterest_url'))
                                        <small class="text-danger">{{ $errors->first('pinterest_url') }}</small>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="card-footer bg-whitesmoke text-md-right">
                                    <button class="btn btn-primary" id="save-btn"><i class="fas fa-check"></i> Update
                                        Details</button>
                                    <a href="{{ route('admin.setting.index') }}" class="btn btn-info"><i class="fas fa-times"></i>
                                        Go back Setting</a>
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
    document.getElementById('phone_number').addEventListener('focus', function() {
            if (!this.value.startsWith('+880')) {
                this.value = '+880' + this.value.replace(/^0/, '');
            }
        });
</script>
@endsection