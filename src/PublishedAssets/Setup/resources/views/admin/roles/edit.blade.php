@extends('siravel::layouts.dashboard')

@section('content')

    <div class="row">
        <h1 class="page-header">{!! trans('siravel::modules.roles') !!}: {!! trans('siravel::modules.edit') !!}</h1>
    </div>
    <div class="row">
        <form method="POST" action="/admin/roles/{{ $role->id }}">
            <input name="_method" type="hidden" value="PATCH">
            {!! csrf_field() !!}

            <div class="col-md-12 form-group">
                @input_maker_label(trans('siravel::modules.name'))
                @input_maker_create('name', ['type' => 'string'], $role)
            </div>

            <div class="col-md-12 form-group">
                @input_maker_label(trans('siravel::modules.label'))
                @input_maker_create('label', ['type' => 'string'], $role)
            </div>

            <div class="col-md-12 form-group">
                <h3>{!! trans('siravel::modules.permissions') !!}</h3>
                @foreach(Config::get('permissions', []) as $permission => $name)
                    <div class="checkbox">
                        <label for="{{ $name }}">
                            @if (stristr($role->permissions, $permission))
                                <input type="checkbox" name="permissions[{{ $permission }}]" id="{{ $name }}" checked>
                            @else
                                <input type="checkbox" name="permissions[{{ $permission }}]" id="{{ $name }}">
                            @endif
                            {{ $name }}
                        </label>
                    </div>
                @endforeach
            </div>

            <div class="col-md-12 form-group">
                <a class="btn btn-default pull-left" href="{{ URL::previous() }}">{!! trans('siravel::modules.cancel') !!}</a>
                <button class="btn btn-primary pull-right" type="submit">{!! trans('siravel::modules.save') !!}</button>
            </div>
        </form>
    </div>

@stop