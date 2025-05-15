@extends('front.layout')

@section('content')
<section class="faq-section py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="title">Frequently Asked Questions</h2>
            <p class="text-muted">Find answers to the most commonly asked questions.</p>
        </div>

        <div class="accordion" id="faqAccordion">
            @foreach($faq_details as $index => $faq)
            <div class="card mb-3 border-0 shadow-sm rounded">
                <div class="card-header bg-white" id="heading{{ $index }}">
                    <h2 class="mb-0">
                        <button 
                            class="btn btn-link btn-block text-left {{ $index !== 0 ? 'collapsed' : '' }}" 
                            type="button" 
                            data-toggle="collapse" 
                            data-target="#collapse{{ $index }}" 
                            aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" 
                            aria-controls="collapse{{ $index }}"
                            style="font-size: 16px; font-weight: 600;"
                        >
                            {{ $faq->heading }}
                        </button>
                    </h2>
                </div>

                <div 
                    id="collapse{{ $index }}" 
                    class="collapse {{ $index === 0 ? 'show' : '' }}" 
                    aria-labelledby="heading{{ $index }}" 
                    data-parent="#faqAccordion"
                >
                    <div class="card-body text-dark text-justify">
                        {!! $faq->description !!}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
