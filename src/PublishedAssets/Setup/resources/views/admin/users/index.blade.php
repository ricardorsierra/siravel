@extends('siravel::layouts.dashboard')

@section('content')

    <div class="row">
        <form id="" class="pull-right raw-margin-left-24" method="post" action="/admin/users/search">
            {!! csrf_field() !!}
            <input class="form-control" name="search" placeholder="{!! trans('siravel::modules.search') !!}">
        </form>
        <a class="btn btn-default pull-right" href="{{ url('admin/users/invite') }}">{!! trans('siravel::modules.inviteNewUser') !!}</a>
        <h1 class="page-header">{!! trans('siravel::modules.users') !!}</h1>
    </div>
    <div class="row">
        <table class="table table-striped raw-margin-top-24">

            <thead>
                <th>{!! trans('siravel::modules.email') !!}</th>
                <th class="text-right">{!! trans('siravel::modules.actions') !!}</th>
            </thead>
            <tbody>
                @foreach($users as $user)

                    @if ($user->id !== Auth::id())
                        <tr>
                            <td>{{ $user->email }}</td>
                            <td>
                                <form method="post" action="{!! url('admin/users/'.$user->id) !!}">
                                    {!! csrf_field() !!}
                                    {!! method_field('DELETE') !!}
                                    <button class="btn btn-danger btn-xs pull-right" type="submit" onclick="return confirm('{!! trans('siravel::modules.temCertezaDeletarUsuario') !!}')"><i class="fa fa-trash"></i> {!! trans('siravel::modules.delete') !!}</button>
                                </form>
                                <a class="btn btn-warning btn-xs pull-right raw-margin-right-16" href="{{ url('admin/users/'.$user->id.'/edit') }}"><span class="fa fa-edit"></span> {!! trans('siravel::modules.edit') !!}</a>
                            </td>
                        </tr>
                    @endif

                @endforeach

            </tbody>

        </table>
    </div>

@stop
