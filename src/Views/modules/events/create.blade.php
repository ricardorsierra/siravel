@extends('siravel::layouts.dashboard')

@section('content')

    <div class="row">
        <h1 class="page-header">Events</h1>
    </div>

    @include('siravel::modules.events.breadcrumbs', ['location' => ['create']])

    <div class="row">
        {!! Form::open(['route' => 'siravel.events.store', 'class' => 'add']) !!}

            {!! FormMaker::fromTable('events', Config::get('siravel.forms.event')) !!}

            <div class="form-group text-right">
                <a href="{!! URL::to('siravel/events') !!}" class="btn btn-default raw-left">{!! trans('siravel::modules.cancel') !!}</a>
                {!! Form::submit(trans('siravel::modules.save'), ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection
