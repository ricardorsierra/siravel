@extends('siravel-frontend::layout.master')

@section('content')

<div class="container">

    <h1>{!! trans('siravel::modules.calendar') !!}</h1>

    <div class="row">
        <div class="col-md-12">
            {!! $calendar->asHtml([ 'class' => 'calendar', 'dates' => $events ]); !!}
            {!! $calendar->links('cal-link btn btn-default'); !!}
        </div>
    </div>

<div class="container">

@endsection

@section('siravel')
    @edit('events')
@endsection