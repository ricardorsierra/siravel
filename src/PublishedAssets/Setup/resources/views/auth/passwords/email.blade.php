@extends('siravel::layouts.blank')

@section('content')

    <div class="row">
        <div class="col-md-4 col-md-offset-4">

            <h1 class="text-center">{!! trans('siravel::modules.forgotPassword') !!}</h1>

            <form method="POST" action="/password/email">
                {!! csrf_field() !!}
                @include('partials.errors')
                @include('partials.status')
                <div class="col-md-12 pull-left">
                    <label>{!! trans('siravel::modules.email') !!}</label>
                    <input class="form-control" type="email" name="email" placeholder="{!! trans('siravel::modules.emailAddress') !!}" value="{{ old('email') }}">
                </div>
                <div class="col-md-12 pull-left form-group">
                    <a class="btn btn-default pull-left" href="/login">{!! trans('siravel::modules.waitIRemember') !!}</a>
                    <button class="btn btn-primary pull-right" type="submit" class="button">{!! trans('siravel::modules.sendPasswordResetLink') !!}</button>
                </div>
            </form>

        </div>
    </div>

@stop
