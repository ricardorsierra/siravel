@extends('siravel::layouts.dashboard')

@section('content')

    <div class="row">
        <h1 class="page-header">{!! trans('siravel::modules.users') !!}: {!! trans('siravel::modules.invite') !!}</h1>
    </div>
    <div class="row">
        <form method="POST" action="/admin/users/invite">
            {!! csrf_field() !!}

            <div class="col-md-12 col-md-12">
                @input_maker_label(trans('siravel::modules.email'))
                @input_maker_create('email', ['type' => 'string'])
            </div>

            <div class="col-md-12 col-md-12">
                @input_maker_label(trans('siravel::modules.name'))
                @input_maker_create('name', ['type' => 'string'])
            </div>

            <div class="col-md-12 col-md-12">
                @input_maker_label(trans('siravel::modules.role'))
                @input_maker_create('roles', ['type' => 'relationship', 'model' => 'App\Models\Role', 'label' => 'label', 'value' => 'name'])
            </div>

            <div class="col-md-12 col-md-12">
                <a class="btn btn-default pull-left" href="{{ URL::previous() }}">{!! trans('siravel::modules.cancel') !!}</a>
                <button class="btn btn-primary pull-right" type="submit">{!! trans('siravel::modules.invite') !!}</button>
            </div>
        </form>
    </div>

@stop