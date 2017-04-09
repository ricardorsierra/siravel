<div class="row">
    @if (isset($createBtn))
        <a class="btn btn-primary pull-right" href="{!! route('siravel.files.create') !!}">{!! trans('siravel::modules.addNew') !!}</a>
    @endif
    <div class="raw-m-hide pull-right raw-m-hide">
        {!! Form::open(['url' => 'siravel/files/search']) !!}
        <input class="form-control header-input pull-right @if (isset($createBtn)) raw-margin-right-24 @endif" name="term" placeholder="Search">
        {!! Form::close() !!}
    </div>
    <h1 class="page-header">{!! trans('siravel::modules.files') !!}</h1>
</div>