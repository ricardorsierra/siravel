@extends('siravel-frontend::layout.master')

@section('seoDescription') {{ $page->seo_description }} @endsection
@section('seoKeywords') {{ $page->seo_keywords }} @endsection

@section('content')

<div class="container">

    <div class="jumbotron">
        <h1>{{ $page->title }}</h1>
    </div>

    {!! $page->entry !!}

</div>

@endsection

@section('siravel')
    @edit('pages', $page->id)
@endsection
