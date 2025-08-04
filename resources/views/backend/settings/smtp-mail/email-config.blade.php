@extends('layouts.backend')
@section('title', 'Edit SMTP')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>SMTP Mail setting</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Edit SMTP</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title"> Email SMTP settings</h2>
            <p class="section-lead">Edit Email SMTP settings</p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('admin.setting.email.index') }}" class="btn btn-primary"><i
                                    class="fa fa-list"></i> Email SMTP settings</a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.setting.email.update') }}" method="POST" class="needs-validation"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-row">
                                    <div class="form-group col-md-6 col-lg-3">
                                        <label>Mail Mailer</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-server"></i>
                                                </div>
                                            </div>
                                            <input type="text" name="MAIL_MAILER" id="MAIL_MAILER" value="{{ env('MAIL_MAILER') }}" class="form-control @error('MAIL_MAILER') is-invalid @enderror"">
                                            
                                        </div>
                                        @if($errors->has('MAIL_MAILER'))
                                        <small class="text-danger">{{ $errors->first('MAIL_MAILER') }}</small>
                                        @endif
                                    </div>
                                
                                    <div class="form-group col-md-6 col-lg-3">
                                        <label>Mail Host</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-envelope"></i>
                                                </div>
                                            </div>
                                            <input type="text" name="MAIL_HOST" id="MAIL_HOST" value="{{ env('MAIL_HOST') }}" class="form-control @error('MAIL_HOST') is-invalid @enderror"">
                                            
                                        </div>
                                        @if($errors->has('MAIL_HOST'))
                                        <small class="text-danger">{{ $errors->first('MAIL_HOST') }}</small>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6 col-lg-3">
                                        <label>Mail Port</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-envelope-open-text"></i>
                                                </div>
                                            </div>
                                            <input type="text" name="MAIL_PORT" id="MAIL_PORT" value="{{ env('MAIL_PORT') }}" class="form-control @error('MAIL_PORT') is-invalid @enderror"">
                                            
                                        </div>
                                        @if($errors->has('MAIL_PORT'))
                                        <small class="text-danger">{{ $errors->first('MAIL_PORT') }}</small>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6 col-lg-3">
                                        <label>Mail Username</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-at"></i>
                                                </div>
                                            </div>
                                            <input type="text" name="MAIL_USERNAME" id="MAIL_USERNAME" value="{{ env('MAIL_USERNAME') }}" class="form-control @error('MAIL_USERNAME') is-invalid @enderror"">
                                            
                                        </div>
                                        @if($errors->has('MAIL_USERNAME'))
                                        <small class="text-danger">{{ $errors->first('MAIL_USERNAME') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6 col-lg-3">
                                        <label>Mail Password</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-key"></i>
                                                </div>
                                            </div>
                                            <input type="text" name="MAIL_PASSWORD" id="MAIL_PASSWORD" value="{{ env('MAIL_PASSWORD') }}" class="form-control @error('MAIL_PASSWORD') is-invalid @enderror"">
                                            
                                        </div>
                                        @if($errors->has('MAIL_PASSWORD'))
                                        <small class="text-danger">{{ $errors->first('MAIL_PASSWORD') }}</small>
                                        @endif
                                    </div>
                                
                                    <div class="form-group col-md-6 col-lg-3">
                                        <label>Mail Encryption</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-lock"></i>
                                                </div>
                                            </div> 
                                            <input type="text" name="MAIL_ENCRYPTION" id="MAIL_ENCRYPTION" value="{{ env('MAIL_ENCRYPTION') }}" class="form-control @error('MAIL_ENCRYPTION') is-invalid @enderror"">
                                            
                                        </div>
                                        @if($errors->has('MAIL_ENCRYPTION'))
                                        <small class="text-danger">{{ $errors->first('MAIL_ENCRYPTION') }}</small>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6 col-lg-3">
                                        <label>Mail From Address</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-paper-plane"></i>
                                                </div>
                                            </div>
                                            <input type="text" name="MAIL_FROM_ADDRESS" id="MAIL_FROM_ADDRESS" value="{{ env('MAIL_FROM_ADDRESS') }}" class="form-control @error('MAIL_FROM_ADDRESS') is-invalid @enderror"">
                                            
                                        </div>
                                        @if($errors->has('MAIL_FROM_ADDRESS'))
                                        <small class="text-danger">{{ $errors->first('MAIL_FROM_ADDRESS') }}</small>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6 col-lg-3">
                                        <label>Mail From Name</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                   <i class="fas fa-user-tie"></i>
                                                </div>
                                            </div>
                                            <input type="text" name="MAIL_FROM_NAME" id="MAIL_FROM_NAME" value="{{ env('MAIL_FROM_NAME') }}" class="form-control @error('MAIL_FROM_NAME') is-invalid @enderror"">
                                            
                                        </div>
                                        @if($errors->has('MAIL_FROM_NAME'))
                                        <small class="text-danger">{{ $errors->first('MAIL_FROM_NAME') }}</small>
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