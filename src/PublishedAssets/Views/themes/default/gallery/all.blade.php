@extends('siravel-frontend::layout.master')

@section('content')

<div class="container">

    <h1 class="page-header">{!! trans('siravel::modules.gallery') !!}</h1>

    <div class="col-md-6">
        @foreach ($images as $image)
            <img class="thumbnail img-responsive" alt="{{ $image->alt_tag }}" src="{{ $image->url }}" />
        @endforeach
    </div>
    <div class="col-md-6">
        @foreach($tags as $tag)
            <a href="{{ url('gallery/'.$tag) }}" class="btn btn-default">{{ $tag }}</a>
        @endforeach
    </div>

</div>

@endsection

@section('siravel')
    @edit('images')
@endsection