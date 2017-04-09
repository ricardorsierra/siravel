@extends('siravel-frontend::layout.master')

@section('content')

<div class="container">

    <div class="row">
        <div class="col-md-12">
            {!! $calendar->asHtml([ 'class' => 'calendar', 'dates' => $events ]); !!}
            {!! $calendar->links('cal-link btn btn-default'); !!}
        </div>
    </div>

@endsection

@section('siravel')
    @edit('events')
@endsection