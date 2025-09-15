@extends('layouts.backend')
@section('title', 'Setting')
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>SEO Content</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a>SEO Setting</a></div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Table of SEO Content</h2>
                <p class="section-lead">Manage and customize SEO content for all pages.</p>

                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h6 class="text-muted">General pages SEO (e,g: Home, Contact, Shop etc.)</h6>
                                <a href="{{ route('admin.setting.seo.create') }}" class="btn btn-primary"><i
                                        class="fa fa-plus"></i> Add SEO</a>

                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped table-md" id="dataTable">
                                        <tr>
                                            <th>#</th>
                                            <th>Page Type</th>
                                            <th>Meta Title</th>
                                            <th>Meta Description</th>
                                            <th>Meta Keywords</th>
                                            <th>Action</th>
                                        </tr>
                                        @if ($seoGenerals->count() > 0)
                                            @foreach ($seoGenerals as $seoGeneral)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $seoGeneral->page_type }}</td>
                                                    <td>{{ $seoGeneral->meta_title }}</td>
                                                    <td>{{ \Illuminate\Support\Str::limit($seoGeneral->meta_description, 50, '...') }}
                                                    </td>
                                                    <td>{{ \Illuminate\Support\Str::limit($seoGeneral->meta_keywords, 50, '...') }}
                                                    </td>
                                                    <td><a href="{{ route('admin.setting.seo.edit', $seoGeneral->id) }}"
                                                            class="btn btn-primary" data-toggle="tooltip"
                                                            title="Edit this details"><i class="far fa-edit"></i> Edit</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6" class="text-center text-danger">
                                                    <p>No Data Found!</p>
                                                    <a href="{{ route('admin.setting.seo.create') }}"
                                                        class="btn btn-primary">Create a new
                                                        one</a>
                                                </td>
                                            </tr>
                                        @endif

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- Category SEO Table --}}
                    <div class="col-12 col-md-12 col-lg-6">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h6 class="text-muted">Category SEO Table</h6>

                                <a href="{{ route('admin.setting.seo.create') }}" class="btn btn-primary"><i
                                        class="fa fa-plus"></i> Add
                                    SEO</a>

                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped table-md table-striped" id="dataTable">
                                        <tr>
                                            <th>#</th>
                                            <th>Category Reference</th>
                                            <th>Meta Title</th>
                                            <th>Meta Description</th>
                                            <th>Meta Keywords</th>
                                            <th>Action</th>
                                        </tr>
                                        @if ($seoCollections->count() > 0)
                                            @foreach ($seoCollections as $seoCollection)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>
                                                        @if ($seoCollection->page_type === 'collection')
                                                            {{ $seoCollection->subCategory->subcategory_name ?? '—' }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $seoCollection->meta_title }}</td>
                                                    <td>{{ \Illuminate\Support\Str::limit($seoCollection->meta_description, 50, '...') }}
                                                    </td>
                                                    <td>{{ \Illuminate\Support\Str::limit($seoCollection->meta_keywords, 50, '...') }}
                                                    </td>
                                                    <td><a href="{{ route('admin.setting.seo.edit', $seoCollection->id) }}"
                                                            class="btn btn-primary" data-toggle="tooltip"
                                                            title="Edit this details"><i class="far fa-edit"></i> Edit</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6" class="text-center text-danger">
                                                    <p>No Data Found!</p>
                                                    <a href="{{ route('admin.setting.seo.create') }}"
                                                        class="btn btn-primary">Create a new
                                                        one</a>
                                                </td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Product SEO Table --}}
                    <div class="col-12 col-md-12 col-lg-6">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h6 class="text-muted">Product SEO Table</h6>

                                <a href="{{ route('admin.setting.seo.create') }}" class="btn btn-primary"><i
                                        class="fa fa-plus"></i> Add
                                    SEO</a>

                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped table-md" id="dataTable">
                                        <tr>
                                            <th>#</th>
                                            <th>Product Reference</th>
                                            <th>Meta Title</th>
                                            <th>Meta Description</th>
                                            <th>Meta Keywords</th>
                                            <th>Action</th>
                                        </tr>
                                        @if ($seoProducts->count() > 0)
                                            @foreach ($seoProducts as $seoProduct)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>
                                                        @if ($seoProduct->page_type === 'product')
                                                            {{ $seoProduct->product->title ?? '—' }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $seoProduct->meta_title }}</td>
                                                    <td>{{ \Illuminate\Support\Str::limit($seoProduct->meta_description, 50, '...') }}
                                                    </td>
                                                    <td>{{ \Illuminate\Support\Str::limit($seoProduct->meta_keywords, 50, '...') }}
                                                    </td>
                                                    <td><a href="{{ route('admin.setting.seo.edit', $seoProduct->id) }}"
                                                            class="btn btn-primary" data-toggle="tooltip"
                                                            title="Edit this details"><i class="far fa-edit"></i> Edit</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6" class="text-center text-danger">
                                                    <p>No Data Found!</p>
                                                    <a href="{{ route('admin.setting.seo.create') }}"
                                                        class="btn btn-primary">Create a new
                                                        one</a>
                                                </td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
