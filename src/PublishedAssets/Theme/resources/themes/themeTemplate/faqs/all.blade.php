@extends('siravel-frontend::layout.master')

@section('content')

<div class="container">

    <h1>{!! trans('siravel::modules.faqs') !!}</h1>

    @foreach($faqs as $faq)
        <div class="container-fluid">
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
        </div>
    @endforeach

</div>

@endsection

@section('siravel')
    @edit('faqs')
@endsection