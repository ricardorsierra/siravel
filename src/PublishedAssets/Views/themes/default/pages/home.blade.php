@extends('siravel-frontend::layout.master')

@if (isset($page))
    @section('seoDescription') {{ $page->seo_description }} @endsection
    @section('seoKeywords') {{ $page->seo_keywords }} @endsection
@endif

@section('content')

<div class="homepage-banner">
    <h1>{{ config('app.name') }}</h1>
    <p class="lead">Artista e Modelo</p>
</div>

<div class="container">

    @if (isset($page))
        {!! $page->entry !!}
    @endif

</div>
@endsection

@section('siravel')
    @if (isset($page))
        @edit('pages', $page->id)
    @endif
@endsection
