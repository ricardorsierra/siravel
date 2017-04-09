@extends('siravel::layouts.navigation')

@section('page-content')

    <div class="overlay"></div>

    <link rel="stylesheet" type="text/css" href="{{ Siravel::asset('css/dashboard.css', 'text/css') }}">

    <div class="row raw-margin-top-50">
        <div class="col-md-12">
            @yield('content')
        </div>
    </div>

    <div class="raw100 raw-left navbar navbar-fixed-bottom">
        <div class="raw100 raw-left siravel-footer">
            <p class="raw-margin-left-20">Brought to you by: <a href="https://sierratecnologia.com.br">Sitec Inc.</a></p>
        </div>
    </div>
@stop
