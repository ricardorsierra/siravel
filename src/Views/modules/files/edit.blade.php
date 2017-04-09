@extends('siravel::layouts.dashboard')

@section('content')

    <div class="row">
        <h1 class="page-header">{!! trans('siravel::modules.files') !!}</h1>
    </div>

    @include('siravel::modules.files.breadcrumbs', ['location' => ['edit']])

    <div class="row raw-margin-bottom-48 raw-margin-top-48 text-center">
        <a class="btn btn-default" href="{!! FileService::fileAsDownload($files->name, $files->location) !!}"><span class="fa fa-download"></span> {!! trans('siravel::modules.download') !!}: {!! $files->name !!}</a>
    </div>

    <div class="row">
        {!! Form::model($files, ['route' => ['siravel.files.update', $files->id], 'files' => true, 'method' => 'patch', 'class' => 'edit']) !!}

            {!! FormMaker::fromObject($files, Config::get('siravel.forms.file-edit')) !!}

            <div class="form-group text-right">
                <a href="{!! URL::to('siravel/files') !!}" class="btn btn-default raw-left">{!! trans('siravel::modules.cancel') !!}</a>
                {!! Form::submit(trans('siravel::modules.save'), ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection

@section('javascript')

    @parent
    {!! Minify::javascript(Siravel::asset('js/bootstrap-tagsinput.min.js', 'application/javascript')) !!}
    {!! Minify::javascript(Siravel::asset('packages/dropzone/dropzone.js', 'application/javascript')) !!}
    {!! Minify::javascript(Siravel::asset('js/files-module.js', 'application/javascript')) !!}
    {!! Minify::javascript(Siravel::asset('js/dropzone-custom.js', 'application/javascript')) !!}

@stop

