@extends('layouts.frontend')
@section('title', 'FAQs')
@section('content')

    <section class="breadcrumb-area">
        <div class="container-fluid custom-container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bc-inner">
                        <p><a href="{{ route('home') }}">Home |</a> FAQs</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-area py-5">
        <div class="container-fluid custom-container">
            <div class="section-heading pb-30 text-center">
                <h3>Frequently Asked <span>Questions</span></h3>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-8 col-xl-8">
                    <!-- FAQ 1 -->
                    <div class="accordion" id="faqAccordion">
                        @foreach ($faqs as $faq)
                            @php
                                $collapseId = 'faqCollapse' . $loop->index;
                                $headingId = 'faqHeading' . $loop->index;
                            @endphp
                            <div class="accordion-item mb-3 shadow-sm rounded">
                                <h2 class="accordion-header" id="{{ $headingId }}">
                                    <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#{{ $collapseId }}"
                                        aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                        aria-controls="{{ $collapseId }}">
                                        {{ $faq->faq_question }}
                                    </button>
                                </h2>
                                <div id="{{ $collapseId }}"
                                    class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                    aria-labelledby="{{ $headingId }}" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        {!! $faq->faq_answer !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
