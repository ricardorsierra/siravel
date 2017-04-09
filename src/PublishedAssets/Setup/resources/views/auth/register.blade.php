@extends('siravel::layouts.blank')

@section('content')

    <div class="row raw-margin-top-72">
        <div class="col-md-4 col-md-offset-4">

            <h1 class="text-center">{!! trans('siravel::modules.register') !!}</h1>

            <form method="POST" action="/register">
                {!! csrf_field() !!}

                @include('partials.errors')
                @include('partials.status')

                <div class="col-md-12 form-group">
                    <label>{!! trans('siravel::modules.name') !!}</label>
                    <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                </div>
                <div class="col-md-12 form-group">
                    <label>{!! trans('siravel::modules.name') !!}</label>
                    <input class="form-control" type="email" name="email" value="{{ old('email') }}">
                </div>
                <div class="col-md-12 form-group">
                    <label>{!! trans('siravel::modules.password') !!}</label>
                    <input class="form-control" type="password" name="password">
                </div>
                <div class="col-md-12 form-group">
                    <label>{!! trans('siravel::modules.confirmPassword') !!}</label>
                    <input class="form-control" type="password" name="password_confirmation">
                </div>
                <div class="col-md-12 form-group">
                    <a class="btn btn-default pull-left" href="/login">{!! trans('siravel::modules.login') !!}</a>
                    <button class="btn btn-primary pull-right" type="submit">{!! trans('siravel::modules.register') !!}</button>
                </div>
            </form>

        </div>
    </div>

@stop