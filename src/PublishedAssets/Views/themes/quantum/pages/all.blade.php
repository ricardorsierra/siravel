@extends('siravel-frontend::layout.master')

@section('content')

<div class="container">

    <h1 class="page-header">{!! trans('siravel::modules.pageDirectory') !!}</h1>

    <table class="table table-striped">
        @foreach($pages as $page)
            <tr>
                <td><a href="{!! url('page/'.$page->url) !!}">{{ $page->title }}</a></td>
            </tr>
        @endforeach
    </table>

</div>

@endsection

@section('siravel')
    @edit('pages')
@endsection