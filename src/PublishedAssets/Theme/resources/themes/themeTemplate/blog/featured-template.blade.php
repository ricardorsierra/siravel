@extends('siravel-frontend::layout.master')

@section('seoDescription') {{ $blog->seo_description }} @endsection
@section('seoKeywords') {{ $blog->seo_keywords }} @endsection

@section('content')

<div class="container">

    <div class="jumbotron">
        <h1>{!! trans('siravel::modules.featuredEntry') !!}</h1>
        <h2>{{ $blog->title }}</h2>
    </div>

    {!! $blog->entry !!}

</div>

@endsection

@section('siravel')
    @edit('blog', $blog->id)
@endsection
