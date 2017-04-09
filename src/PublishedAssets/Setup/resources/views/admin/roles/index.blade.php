@extends('siravel::layouts.dashboard')

@section('content')

    <div class="row">
        <form id="" class="pull-right raw-margin-left-24" method="post" action="/admin/roles/search">
            {!! csrf_field() !!}
            <input class="form-control" name="search" placeholder="{!! trans('siravel::modules.search') !!}">
        </form>
        <a class="btn btn-default pull-right" href="{{ url('admin/roles/create') }}">{!! trans('siravel::modules.createNewRole') !!}</a>
        <h1 class="page-header">{!! trans('siravel::modules.roles') !!}</h1>
    </div>
    <div class="row">
        <table class="table table-striped raw-margin-top-24">

            <thead>
                <th>{!! trans('siravel::modules.name') !!}</th>
                <th>{!! trans('siravel::modules.label') !!}</th>
                <th class="text-right">{!! trans('siravel::modules.actions') !!}</th>
            </thead>
            <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->label }}</td>
                        <td>
                            <form method="post" action="{!! url('admin/roles/'.$role->id) !!}">
                                {!! csrf_field() !!}
                                {!! method_field('DELETE') !!}
                                <button class="btn btn-danger btn-xs pull-right" type="submit" onclick="return confirm('{!! trans('siravel::modules.temCertezaDeletarGrupo') !!}')"><i class="fa fa-trash"></i> {!! trans('siravel::modules.delete') !!}</button>
                            </form>
                            <a class="btn btn-warning btn-xs pull-right raw-margin-right-16" href="{{ url('admin/roles/'.$role->id.'/edit') }}"><span class="fa fa-edit"></span> {!! trans('siravel::modules.edit') !!}</a>
                        </td>
                    </tr>
                @endforeach

            </tbody>

        </table>
    </div>

@stop
