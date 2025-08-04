@extends('layouts.backend')
@section('title', 'Create Product')
@section('content')
@extends('layouts.backend')
@section('title', 'Create SEO')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>SEO Setting</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Create SEO</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Create SEO</h2>
            <p class="section-lead">Fill out the form below to add a new seo.</p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('admin.setting.seo.index') }}" class="btn btn-primary"><i
                                    class="fa fa-list"></i> SEO Table</a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.setting.seo.update', $seoSetting->id) }}" method="POST" class="needs-validation"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                {{-- Page Type --}}
                                <div class="form-group row align-items-center">
                                    <label class="form-control-label col-sm-3 text-md-right">Page Type <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-6 col-md-9">
                                        <select class="form-control @error('page_type') is-invalid @enderror" name="page_type" id="page_type">
                                            <option value="" disabled {{ old('page_type', $seoSetting->page_type ?? '') == '' ? 'selected' : '' }}>
                                                ---Please Select an Option---
                                            </option>
                                            <option value="home" {{ old('page_type', $seoSetting->page_type ?? '') == 'home' ? 'selected' : '' }}>Home</option>
                                            <option value="collection" {{ old('page_type', $seoSetting->page_type ?? '') == 'collection' ? 'selected' : ''
                                                }}>Collection</option>
                                            <option value="product" {{ old('page_type', $seoSetting->page_type ?? '') == 'product' ? 'selected' : '' }}>Shop</option>
                                            <option value="contact" {{ old('page_type', $seoSetting->page_type ?? '') == 'contact' ? 'selected' : '' }}>Contact
                                            </option>
                                        </select>
                                        @if($errors->has('page_type'))
                                        <small class="text-danger">{{ $errors->first('page_type') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <input type="hidden" name="reference_id" id="reference_id"
                                    value="{{ old('reference_id') }}">

                                <!-- Collection Select -->
                                <div class="form-group row align-items-center" id="category_select"
                                    style="display: none;">
                                    <label class="form-control-label col-sm-3 text-md-right">Collection ID
                                        (Optional)</label>
                                    <div class="col-sm-6 col-md-9">
                                        <select class="form-control select2" id="collection_id">
                                            <option value="" disabled {{ old('reference_id', $seoSetting->reference_id ?? '') == '' ? 'selected' : '' }}>---Select Collection---</option>
                                            @foreach($subCategories as $subCategory)
                                            <option value="{{ $subCategory->id }}" {{ old('reference_id', $seoSetting->reference_id ?? '') == $subCategory->id ? 'selected' : '' }}>
                                                {{ $subCategory->subcategory_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Product Select -->
                                <div class="form-group row align-items-center" id="product_select"
                                    style="display: none;">
                                    <label class="form-control-label col-sm-3 text-md-right">Product ID
                                        (Optional)</label>
                                    <div class="col-sm-6 col-md-9">
                                        <select class="form-control select2" id="product_id">
                                            <option value="" {{ old('reference_id', $seoSetting->reference_id ?? '') == '' ? 'selected' : '' }} disabled>Select Product</option>
                                            @foreach($products as $product)
                                            <option value="{{ $product->id }}" {{ old('reference_id', $seoSetting->reference_id ?? '') == $product->id ? 'selected' : '' }}>
                                                {{ $product->title }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- Meta Title --}}
                                <div class="form-group row align-items-center">
                                    <label for="meta_title" class="form-control-label col-sm-3 text-md-right">Meta
                                        Title</label>
                                    <div class="col-sm-6 col-md-9">
                                        <input type="text" name="meta_title"
                                            class="form-control @error('meta_title') is-invalid @enderror"
                                            id="meta_title" placeholder="Enter meta title for SEO"
                                            value="{{ old('meta_title', $seoSetting->meta_title ?? '') }}">
                                        @if($errors->has('meta_title'))
                                        <small class="text-danger">{{ $errors->first('meta_title') }}</small>
                                        @endif
                                    </div>
                                </div>

                                {{-- Meta Description --}}
                                <div class="form-group row align-items-center">
                                    <label for="meta_description" class="form-control-label col-sm-3 text-md-right">Meta
                                        Description</label>
                                    <div class="col-sm-6 col-md-9">
                                        <textarea class="form-control @error('meta_description') is-invalid @enderror"
                                            name="meta_description" id="meta_description"
                                            placeholder="Enter a brief meta description for SEO">{{ old('meta_description', $seoSetting->meta_description ?? '') }}</textarea>
                                        @if($errors->has('meta_description'))
                                        <small class="text-danger">{{ $errors->first('meta_description') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row align-items-center">
                                    <label for="meta_keywords" class="form-control-label col-sm-3 text-md-right">Meta
                                        Keywords</label>
                                    <div class="col-sm-6 col-md-9">
                                        <input type="text" name="meta_keywords"
                                            class="form-control @error('meta_keywords') is-invalid @enderror"
                                            id="meta_keywords" placeholder="e.g. clothing, fashion, men, women"
                                            value="{{ old('meta_keywords', $seoSetting->meta_keywords ?? '') }}">
                                        @if($errors->has('meta_keywords'))
                                        <small class="text-danger">{{ $errors->first('meta_keywords') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="card-footer bg-whitesmoke text-md-right">
                                    <a href="{{ url()->previous() }}" class="btn btn-danger"><i class="fas fa-times"></i>
                                        Cancel</a>
                                    
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
    $(document).ready(function () {
    $('.select2').select2({
        width: '100%'
    });
    
    function toggleFields() {
        const type = $('#page_type').val();

        if (type === 'collection') {
            $('#category_select').show();
            $('#product_select').hide();
            $('#reference_id').val($('#collection_id').val());
        } else if (type === 'product') {
            $('#category_select').hide();
            $('#product_select').show();
            $('#reference_id').val($('#product_id').val());
        } else {
            $('#category_select').hide();
            $('#product_select').hide();
            $('#reference_id').val('');
        }
    }

    // Initial call (for old values or editing case)
    toggleFields();

    $('#page_type').on('change', function () {
        toggleFields();
    });

    // When selecting collection
    $('#collection_id').on('change', function () {
        const selected = $(this).val();
        $('#reference_id').val(selected);
    });

    // When selecting product
    $('#product_id').on('change', function () {
        const selected = $(this).val();
        $('#reference_id').val(selected);
    });
});
</script>
@endsection
@endsection