@extends('siravel-frontend::layout.master')

@section('content')

<div class="container">

    <h1>{!! trans('siravel::modules.pages') !!}</h1>

    @foreach($pages as $page)
        <a href="{!! url('page/'.$page->url) !!}">{{ $page->title }}</a><br>
    @endforeach

</div>

@endsection

@section('siravel')
    @edit('pages')
@endsection