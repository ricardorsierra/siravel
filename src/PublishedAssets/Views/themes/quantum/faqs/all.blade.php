@extends('siravel-frontend::layout.master')

@section('content')

<div class="container">

    <h1 class="page-header">{!! trans('siravel::modules.faqs') !!}</h1>

    <div class="entry-row">
        @widget('faq-description')
    </div>

    @foreach($faqs as $faq)
        @if (config('app.locale') !== config('siravel.default-language'))
            <blockquote>{!! $faq->translationData(config('app.locale'))->question !!}</blockquote>
            <div class="well">
                {!! $faq->translationData(config('app.locale'))->answer !!}
            </div>
            @edit('faqs', $faq->id)
        @else
            <blockquote>{!! $faq->question !!}</blockquote>
            <div class="well">
                {!! $faq->answer !!}
            </div>
            @edit('faqs', $faq->id)
        @endif
    @endforeach

</div>

@endsection

@section('siravel')
    @edit('faqs')
@endsection