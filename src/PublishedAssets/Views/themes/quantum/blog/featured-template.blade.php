@extends('siravel-frontend::layout.master')

@section('seoDescription') {{ $blog->seo_description }} @endsection
@section('seoKeywords') {{ $blog->seo_keywords }} @endsection

@section('content')

<div class="container">

    <h1 class="page-header">{!! $blog->title !!} <span class="pull-right">{!! \Carbon\Carbon::parse($blog->published_at)->format('d M, Y') !!}</span></h1>

    <div class="well entry-row">
        <h2>{!! trans('siravel::modules.featuredEntry') !!}</h2>
    </div>

    <div class="entry-row">
        {!! $blog->entry !!}
    </div>

</div>

@endsection

@section('siravel')
    @edit('blog', $blog->id)
@endsection
