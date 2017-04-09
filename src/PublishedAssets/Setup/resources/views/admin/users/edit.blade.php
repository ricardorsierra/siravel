@extends('siravel::layouts.dashboard')

@section('content')

    <div class="row">
        @if (! Session::get('original_user'))
            <a class="btn btn-default pull-right" href="/admin/users/switch/{{ $user->id }}">{!! trans('siravel::modules.loginAsThisUser') !!}</a>
        @endif
        <h1 class="page-header">{!! trans('siravel::modules.Users') !!}: {!! trans('siravel::modules.edit') !!}</h1>
    </div>
    <div class="row">
        <form method="POST" action="/admin/users/{{ $user->id }}">
            <input name="_method" type="hidden" value="PATCH">
            {!! csrf_field() !!}

            <div class="col-md-12 col-md-12">
                @input_maker_label(trans('siravel::modules.email'))
                @input_maker_create('email', ['type' => 'string'], $user)
            </div>

            <div class="col-md-12 col-md-12">
                @input_maker_label(trans('siravel::modules.name'))
                @input_maker_create('name', ['type' => 'string'], $user)
            </div>

            @include('user.meta')

            <div class="col-md-12 col-md-12">
                @input_maker_label(trans('siravel::modules.role'))
                @input_maker_create('roles', ['type' => 'relationship', 'model' => 'App\Models\Role', 'label' => 'label', 'value' => 'name'], $user)
            </div>

            <div class="col-md-12 col-md-12">
                <a class="btn btn-default pull-left" href="{{ URL::previous() }}">{!! trans('siravel::modules.cancel') !!}</a>
                <button class="btn btn-primary pull-right" type="submit">{!! trans('siravel::modules.save') !!}</button>
            </div>
        </form>
    </div>

@stop