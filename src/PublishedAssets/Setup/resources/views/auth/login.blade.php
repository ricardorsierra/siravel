@extends('siravel::layouts.blank')

@section('content')

    <div class="row">
        <div class="col-md-4 col-md-offset-4">

            <h1 class="text-center">{!! trans('siravel::modules.login') !!}</h1>

            <form method="POST" action="/login">
                {!! csrf_field() !!}
                <div class="col-md-12 form-group">
                    <label>{!! trans('siravel::modules.email') !!}</label>
                    <input class="form-control" type="email" name="email" value="{{ old('email') }}">
                </div>
                <div class="col-md-12 form-group">
                    <label>{!! trans('siravel::modules.password') !!}</label>
                    <input class="form-control" type="password" name="password" id="password">
                </div>
                <div class="col-md-12 form-group">
                    <label>
                        {!! trans('siravel::modules.rememberMe') !!} <input type="checkbox" name="remember">
                    </label>
                </div>
                <div class="col-md-12 form-group">
                    <a class="btn btn-default pull-left" href="/password/reset">{!! trans('siravel::modules.forgotPassword') !!}</a>
                    <button class="btn btn-primary pull-right" type="submit">{!! trans('siravel::modules.login') !!}</button>
                </div>

                <div class="col-md-12 form-group">
                    @if (Config::get('siravel.registration-available', false))
                        <a class="btn raw100 btn-info" href="/register">{!! trans('siravel::modules.register') !!}</a>
                    @endif
                </div>
            </form>

        </div>
    </div>

@stop

