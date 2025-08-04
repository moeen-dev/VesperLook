@extends('layouts.backend')
@section('title', 'Create Product')

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
            <h2 class="section-title">Create Product</h2>
            <p class="section-lead">Fill out the form below to add a new product.</p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Fill in the details and click Save.</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('products.update', $product->id) }}" method="POST" class="needs-validation" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Product Title</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control" name="title" id="title" value="{{ $product->title }}">
                                        @if($errors->has('title'))
                                        <small class="text-danger">{{ $errors->first('title') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Product Slug</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control" name="slug" id="slug" value="{{ $product->slug }}">
                                        @if($errors->has('slug'))
                                        <small class="text-danger">{{ $errors->first('slug') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Sub Category</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control select2" name="sub_category_id">
                                            <option value="">Select Sub Category</option>
                                            @foreach($subcategories as $subcategory)
                                            <option value="{{ $subcategory->id }}" {{ $product->sub_category_id == $subcategory->id ? 'selected' : '' }}>{{ $subcategory->subcategory_name }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('sub_category_id'))
                                        <small class="text-danger">{{ $errors->first('sub_category_id') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Price</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="number" step="0.01" class="form-control" name="price" value="{{ $product->price }}">
                                        @if($errors->has('price'))
                                        <small class="text-danger">{{ $errors->first('price') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Sizes</label>
                                    <div class="col-sm-12 col-md-7">
                                        <label>
                                            <input type="checkbox" name="sizes[]" value="S"
                                                {{ in_array('S', $product->sizes ?? []) ? 'checked' : '' }}> S
                                        </label>
                                        <label>
                                            <input type="checkbox" name="sizes[]" value="M"
                                                {{ in_array('M', $product->sizes ?? []) ? 'checked' : '' }}> M
                                        </label>
                                        <label>
                                            <input type="checkbox" name="sizes[]" value="L"
                                                {{ in_array('L', $product->sizes ?? []) ? 'checked' : '' }}> L
                                        </label>
                                        <label>
                                            <input type="checkbox" name="sizes[]" value="XL"
                                                {{ in_array('XL', $product->sizes ?? []) ? 'checked' : '' }}> XL
                                        </label>
                                        <label>
                                            <input type="checkbox" name="sizes[]" value="XXL"
                                                {{ in_array('XXL', $product->sizes ?? []) ? 'checked' : '' }}> XXL
                                        </label>
                                        @if($errors->has('sizes'))
                                        <small class="text-danger">{{ $errors->first('sizes') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Product Colors</label>
                                    <div class="col-sm-12 col-md-7">
                                        <!-- Multiple color picker input fields in one row -->
                                        <div class="row">
                                            <div class="col-6 mb-2">
                                                <div class="input-group colorpickerinput">
                                                    <input type="text" name="colors[]" class="form-control" value="{{ isset($product->colors[0]) ? $product->colors[0] : '' }}">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-fill-drip"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 mb-2">
                                                <div class="input-group colorpickerinput">
                                                    <input type="text" name="colors[]" class="form-control" value="{{ isset($product->colors[1]) ? $product->colors[1] : '' }}">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-fill-drip"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 mb-2">
                                                <div class="input-group colorpickerinput">
                                                    <input type="text" name="colors[]" class="form-control" value="{{ isset($product->colors[2]) ? $product->colors[2] : '' }}">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-fill-drip"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 mb-2">
                                                <div class="input-group colorpickerinput">
                                                    <input type="text" name="colors[]" class="form-control" value="{{ isset($product->colors[3]) ? $product->colors[3] : '' }}">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-fill-drip"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <small>Select up to 4 colors</small>

                                        @if($errors->has('colors'))
                                        <small style="color: red;">{{ $errors->first('colors') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Product Description</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea class="form-control summernote" name="description" rows="5">{{ $product->description }}</textarea>
                                        @if($errors->has('description'))
                                        <small class="text-danger">{{ $errors->first('description') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                        Product Images (Dimension: 500*500px, Max: 2MB each)
                                    </label>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="row">
                                            <!-- First Row: 2 Image Upload Fields -->
                                            <div class="col-sm-6 col-md-6 mb-2">
                                                <input type="file" name="image1" id="image1" class="form-image" data-default-file="{{ url('upload/images', $product->image1) }}">
                                                @if($errors->has('image1'))
                                                <small style="color: red;">{{ $errors->first('image1')}}</small>
                                                @endif
                                            </div>
                                            <div class="col-sm-6 col-md-6 mb-2">
                                                <input type="file" name="image2" id="image2" class="form-image" data-default-file="{{ url('upload/images', $product->image2) }}">
                                                @if($errors->has('image2'))
                                                <small style="color: red;">{{ $errors->first('image2')}}</small>
                                                @endif
                                            </div>

                                            <!-- Second Row: 2 Image Upload Fields -->
                                            <div class="col-sm-6 col-md-6 mb-2">
                                                <input type="file" name="image3" id="image3" class="form-image" data-default-file="{{ url('upload/images', $product->image3) }}">
                                                @if($errors->has('image3'))
                                                <small style="color: red;">{{ $errors->first('image3')}}</small>
                                                @endif
                                            </div>
                                            <div class="col-sm-6 col-md-6 mb-2">
                                                <input type="file" name="image4" id="image4" class="form-image" data-default-file="{{ url('upload/images', $product->image4) }}">
                                                @if($errors->has('image4'))
                                                <small style="color: red;">{{ $errors->first('image4')}}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Is New Arrival?</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control" name="is_new">
                                            <option value="1" {{ $product->is_new == '1' ? 'selected' : '' }}>Yes</option>
                                            <option value="0" {{ $product->is_new == '0' ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Quantity</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="number" class="form-control" name="quantity" value="{{ $product->quantity }}" min="0" placeholder="If null or Out of Stock, type 0">
                                        @if($errors->has('quantity'))
                                        <small class="text-danger">{{ $errors->first('quantity') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button type="submit" class="btn btn-primary">Update Product</button>
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
    // slug input
    $("#title").keyup(function() {
        var text = $(this).val();
        text = text.toLowerCase().replace(/[^a-zA-Z0-9]+/g, '-');
        $("#slug").val(text);
    });

    // color input
    $(".colorpickerinput").colorpicker({
        format: 'hex',
        component: '.input-group-append',
    });

    // select search input
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: 'Select Sub Category',
            allowClear: true
        });
    });
</script>
@endsection