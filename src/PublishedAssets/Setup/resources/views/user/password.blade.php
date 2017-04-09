@extends('siravel-frontend::layout.master')

@section('content')

    <div class="container">
        <div class="row">
            <h1 class="page-header">{!! trans('siravel::modules.password') !!}</h1>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="profile-image" style="background-image: url(https://www.gravatar.com/avatar/{{ md5($user->email) }}?s=400)"></div>
            </div>
            <div class="col-md-8">
                <form method="POST" action="/user/password">
                    {!! csrf_field() !!}

                    <div class="col-md-12 form-group">
                        <label>{!! trans('siravel::modules.oldPassword') !!}</label>
                        <input class="form-control" type="password" name="old_password" placeholder="{!! trans('siravel::modules.oldPassword') !!}">
                    </div>

                    <div class="col-md-12 form-group">
                        <label>{!! trans('siravel::modules.newPassword') !!}</label>
                        <input class="form-control" type="password" name="new_password" placeholder="{!! trans('siravel::modules.newPassword') !!}">
                    </div>

                    <div class="col-md-12 form-group">
                        <label>{!! trans('siravel::modules.confirmPassword') !!}</label>
                        <input class="form-control" type="password" name="new_password_confirmation" placeholder="{!! trans('siravel::modules.confirmPassword') !!}">
                    </div>

                    <div class="col-md-12 form-group">
                        <a class="btn btn-default pull-left" href="{{ URL::previous() }}">{!! trans('siravel::modules.cancel') !!}</a>
                        <button class="btn btn-primary pull-right" type="submit">{!! trans('siravel::modules.save') !!}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@stop
