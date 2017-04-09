@extends('siravel::layouts.dashboard')

@section('content')

    <div class="row">
        <h1 class="page-header">{!! trans('siravel::modules.images') !!}</h1>
    </div>

    @include('siravel::modules.images.breadcrumbs', ['location' => ['create']])

    <div class="row">
        {!! Form::open(['url' => 'siravel/images/upload', 'files' => true, 'class' => 'dropzone', 'id' => 'fileDropzone']); !!}
        {!! Form::close() !!}

        {!! Form::open(['route' => 'siravel.images.store', 'files' => true, 'id' => 'fileDetailsForm', 'class' => 'add']) !!}

            {!! FormMaker::fromTable('files', Config::get('siravel.forms.images')) !!}

            <div class="form-group text-right">
                <a href="{!! URL::to('siravel/images') !!}" class="btn btn-default raw-left">{!! trans('siravel::modules.cancel') !!}</a>
                {!! Form::submit(trans('siravel::modules.save'), ['class' => 'btn btn-primary', 'id' => 'saveImagesBtn']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection
