@extends('layouts.backend')
@section('title', 'Create Banner')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Table</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ Route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Banner</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Banner</h2>
                <p class="section-lead">All of your banner here</p>

                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('banner.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>
                                    Add New Banner</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($banners->count() > 0)
                                                @foreach ($banners as $banner)
                                                    <tr>
                                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                                        <td>
                                                            <img style="width: 100px; height: auto;"
                                                                src="{{ url('upload/images', $banner->image) }}"
                                                                alt="banner_image">
                                                        </td>
                                                        <td class="d-flex justify-content-center align-items-center"
                                                            style="gap: 10px;">
                                                            <a href="{{ route('banner.edit', $banner->id) }}"
                                                                class="btn btn-info" data-toggle="tooltip"
                                                                title="Edit this banner"><i class="far fa-edit"></i>
                                                                Edit</a>
                                                            <form action="{{ route('banner.destroy', $banner->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button data-toggle="tooltip" title="Delete this banner"
                                                                    class="btn btn-danger" type="submit"
                                                                    onclick="return confirm('Do you want to delete it?')"><i
                                                                        class="fas fa-times"></i> Delete</button>
                                                            </form>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="5" class="text-center text-danger">
                                                        <p>No Data Found!</p>
                                                        <a href="{{ route('banner.create') }}"
                                                            class="btn btn-primary">Create a new one</a>
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
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
