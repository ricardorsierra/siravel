@extends('siravel::layouts.dashboard')

@section('content')

    <div class="row">
        <h1 class="page-header">{!! trans('siravel::modules.blog') !!}</h1>
    </div>

    @include('siravel::modules.blogs.breadcrumbs', ['location' => ['create']])

    <div class="row">
        {!! Form::open(['route' => 'siravel.blog.store', 'class' => 'add']) !!}

            {!! FormMaker::fromTable('blogs', Config::get('siravel.forms.blog')) !!}

            <div class="form-group text-right">
                <a href="{!! URL::to('siravel/blog') !!}" class="btn btn-default raw-left">{!! trans('siravel::modules.cancel') !!}</a>
                {!! Form::submit(trans('siravel::modules.save'), ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection
