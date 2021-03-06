@extends('siravel-frontend::layout.master')

@section('seoDescription') {{ $page->seo_description }} @endsection
@section('seoKeywords') {{ $page->seo_keywords }} @endsection

@section('content')

<div class="container">

    <h1>{!! $page->title !!}</h1>
    {!! $page->entry !!}

</div>

@endsection

@section('siravel')
    @edit('pages', $page->id)
@endsection
