@extends('layouts.backend')
@section('title', 'FAQ Table')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Table</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ Route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">FAQs</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">FAQs</h2>
                <p class="section-lead">All of your FAQs here</p>

                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <a href="{{ route('admin.setting.faq.create') }}" class="btn btn-primary"><i
                                        class="fa fa-plus"></i>
                                    Add FAQ</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">FAQ Question</th>
                                                <th scope="col">FAQ Answer</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($faqs->count() > 0)
                                                @foreach ($faqs as $faq)
                                                    <tr>
                                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                                        <td>{{ $faq->faq_question }}</td>
                                                        <td>{!! $faq->faq_answer !!}</td>
                                                        <td class="d-flex justify-content-center align-items-center"
                                                            style="gap: 10px;">
                                                            <a href="{{ route('admin.setting.faq.edit', $faq->id) }}"
                                                                class="btn btn-info" data-toggle="tooltip"
                                                                title="Edit this FAQ"><i class="far fa-edit"></i>
                                                                Edit</a>
                                                            <form
                                                                action="{{ route('admin.setting.faq.destroy', $faq->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button data-toggle="tooltip" title="Delete this FAQ"
                                                                    class="btn btn-danger" type="submit"
                                                                    onclick="return confirm('Do you want to delete it?')"><i
                                                                        class="fas fa-times"></i> Delete</button>
                                                            </form>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="6" class="text-center text-danger">
                                                        <p>No Data Found!</p>
                                                        <a href="{{ route('coupon.create') }}"
                                                            class="btn btn-primary">Create a new one</a>
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <nav class="d-inline-block">
                                    {{ $faqs->withQueryString()->links('pagination::bootstrap-5') }}
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
