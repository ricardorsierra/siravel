@extends('siravel-frontend::layout.master')

@section('seoDescription') {{ $page->seo_description }} @endsection
@section('seoKeywords') {{ $page->seo_keywords }} @endsection

@section('content')

<div class="container">

    <div class="jumbotron">
        <h1>{!! trans('siravel::modules.featuredPage') !!}</h1>
        <h2>{{ $page->title }}</h2>
    </div>

    @markdown($page->entry)

</div>

@endsection

@section('siravel')
    @edit('pages', $page->id)
@endsection
