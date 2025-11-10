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
                            <form action="{{ route('admin.setting.seo.store') }}" method="POST" class="needs-validation"
                                enctype="multipart/form-data">
                                @csrf

                                {{-- Page Type --}}
                                <div class="form-group row align-items-center">
                                    <label class="form-control-label col-sm-3 text-md-right">Page Type <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-6 col-md-9">
                                        <select class="form-control @error('page_type') is-invalid @enderror"
                                            name="page_type" id="page_type">
                                            <option value="" selected disabled>---Please Select an Option---</option>

                                            <option value="home" {{ old('page_type')=='home' ? 'selected' : '' }}>Home
                                            </option>

                                            <option value="collection" {{ old('page_type')=='collection' ? 'selected'
                                                : '' }}>Collection</option>

                                            <option value="product" {{ old('page_type')=='product' ? 'selected' : '' }}>
                                                Shop</option>

                                            <option value="contact" {{ old('page_type')=='contact' ? 'selected' : '' }}>
                                                Contact</option>

                                            <option value="paymentpolicy" {{ old('page_type')=='paymentpolicy'
                                                ? 'selected' : '' }}>Payment Policy</option>

                                            <option value="privacy" {{ old('page_type')=='privacy' ? 'selected' : '' }}>
                                                Privacy Policy</option>

                                            <option value="customerservice" {{ old('page_type')=='customerservice'
                                                ? 'selected' : '' }}>Customer Service</option>
                                            <option value="aboutus" {{ old('page_type')=='aboutus'
                                                ? 'selected' : '' }}>About Us</option>

                                            <option value="support" {{ old('page_type')=='support' ? 'selected' : '' }}>
                                                Support Center</option>

                                            <option value="exchange" {{ old('page_type')=='exchange' ? 'selected' : ''
                                                }}>
                                                Returns & Exchange</option>

                                            <option value="faq" {{ old('page_type')=='faq' ? 'selected' : '' }}>
                                                Frequently Asked Question's (FAQ's)</option>
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
                                        (If Only Collection then blank it.)</label>
                                    <div class="col-sm-6 col-md-9">
                                        <select class="form-control select2" id="collection_id">
                                            <option value="" selected disabled>Select Collection</option>
                                            @foreach($subCategories as $subCategory)

                                            @php
                                            $hasSeo = in_array($subCategory->id, $seoCollectionIds);
                                            @endphp

                                            <option value="{{ $subCategory->id }}" {{
                                                old('reference_id')==$subCategory->id ? 'selected' : '' }}>
                                                {!! $hasSeo ? '<span style="color:green;">✅</span>' : '' !!}
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
                                        (If Only Shop then blank it.)</label>
                                    <div class="col-sm-6 col-md-9">
                                        <select class="form-control select2" id="product_id">
                                            <option value="" selected disabled>---Select Product---</option>
                                            @foreach($products as $product)

                                            @php
                                            $hasSeo = in_array($product->id, $seoProductIds);
                                            @endphp

                                            <option value="{{ $product->id }}" {{ old('reference_id')==$product->id ?
                                                'selected' : '' }} required>
                                                {!! $hasSeo ? '<span style="color:green;">✅</span>' : '' !!}
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
                                            value="{{ old('meta_title') }}">
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
                                            placeholder="Enter a brief meta description for SEO">{{ old('meta_description') }}</textarea>
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
                                            value="{{ old('meta_keywords') }}">
                                        @if($errors->has('meta_keywords'))
                                        <small class="text-danger">{{ $errors->first('meta_keywords') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="card-footer bg-whitesmoke text-md-right">

                                    <a href="{{ url()->previous() }}" class="btn btn-danger"><i
                                            class="fas fa-times"></i>
                                        Cancel</a>

                                    <button class="btn btn-primary" id="save-btn"><i class="fas fa-check"></i> Save
                                        Details</button>

                                    <a href="{{ route('admin.setting.index') }}" class="btn btn-info"><i
                                            class="fas fa-times"></i>
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