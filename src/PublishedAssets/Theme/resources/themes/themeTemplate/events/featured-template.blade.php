@extends('siravel-frontend::layout.master')

@section('seoDescription') {{ $event->seo_description }} @endsection
@section('seoKeywords') {{ $event->seo_keywords }} @endsection

@section('content')

<div class="container">

    <div class="jumbotron">
        <h1>{!! trans('siravel::modules.featuredEvent') !!}</h1>
        <h2>{{ $event->title }}</h2>
    </div>

    @if (config('app.locale') !== config('siravel.default-language'))
        <h1>{!! $event->translationData(config('app.locale'))->title !!}</h1>
        <p>{!! $event->translationData(config('app.locale'))->start_date !!} - {!! $event->translationData(config('app.locale'))->end_date !!}</p>
        {!! $event->translationData(config('app.locale'))->details !!}
    @else
        <h1>{!! $event->title !!}</h1>
        <p>{!! $event->start_date !!} - {!! $event->end_date !!}</p>
        {!! $event->details !!}
    @endif

</div>

@endsection

@section('siravel')
    @edit('events', $event->id)
@endsection
