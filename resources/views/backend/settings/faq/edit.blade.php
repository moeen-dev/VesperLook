@extends('layouts.backend')
@section('title', 'Edit FAQ')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Frequently Asked Question</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Edit FAQ</div>
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
                                <form action="{{ route('admin.setting.faq.update', $faq->id) }}" method="POST"
                                    class="needs-validation" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Privacy
                                            Policy</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input class="form-control" name="faq_question"
                                                value="{{ old('faq_question', $faq->faq_question ?? '') }}">
                                            @if ($errors->has('faq_question'))
                                                <small class="text-danger">{{ $errors->first('faq_question') }}</small>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Privacy
                                            Policy</label>
                                        <div class="col-sm-12 col-md-7">
                                            <textarea class="form-control summernote" name="faq_answer" rows="5">{{ old('faq_answer', $faq->faq_answer ?? '') }}</textarea>
                                            @if ($errors->has('faq_answer'))
                                                <small class="text-danger">{{ $errors->first('faq_answer') }}</small>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                        <div class="col-sm-12 col-md-7">
                                            <button type="submit" class="btn btn-primary">Update Payment Policy</button>
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
