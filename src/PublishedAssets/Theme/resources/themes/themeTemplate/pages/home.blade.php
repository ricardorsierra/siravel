@extends('siravel-frontend::layout.master')

@if (isset($page))
    @section('seoDescription') {{ $page->seo_description }} @endsection
    @section('seoKeywords') {{ $page->seo_keywords }} @endsection
@endif

@section('content')

<div class="container">

    <div class="jumbotron">
        <h1>{!! $page->title or 'Página Inicial' !!}</h1>
    </div>

    @if (isset($page))
        {!! $page->entry !!}
    @else
        <div class="row">
        </div>
    @endif

</div>
@endsection

@section('siravel')
    @if (isset($page))
        @edit('pages', $page->id)
    @endif
@endsection
