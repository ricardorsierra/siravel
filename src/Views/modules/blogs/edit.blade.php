@extends('siravel::layouts.dashboard')

@section('content')

    <div class="row">
        @if (! is_null(request('lang')) && request('lang') !== config('siravel.default-language', 'en') && $blog->translationData(request('lang')))
            @if (isset($blog->translationData(request('lang'))->is_published))
                <a class="btn btn-default pull-right raw-margin-left-8" href="{!! url('blog/'.$blog->translationData(request('lang'))->url) !!}">{!! trans('siravel::modules.live') !!}</a>
            @else
                <a class="btn btn-default pull-right raw-margin-left-8" href="{!! url('siravel/preview/blog/'.$blog->id.'?lang='.request('lang')) !!}">{!! trans('siravel::modules.preview') !!}</a>
            @endif
            <a class="btn btn-warning pull-right raw-margin-left-8" href="{!! Siravel::rollbackUrl($blog->translation(request('lang'))) !!}">{!! trans('siravel::modules.rollback') !!}</a>
        @else
            @if ($blog->is_published)
                <a class="btn btn-default pull-right raw-margin-left-8" href="{!! url('blog/'.$blog->url) !!}">{!! trans('siravel::modules.live') !!}</a>
            @else
                <a class="btn btn-default pull-right raw-margin-left-8" href="{!! url('siravel/preview/blog/'.$blog->id) !!}">{!! trans('siravel::modules.preview') !!}</a>
            @endif
            <a class="btn btn-warning pull-right raw-margin-left-8" href="{!! Siravel::rollbackUrl($blog) !!}">{!! trans('siravel::modules.rollback') !!}</a>
            <a class="btn btn-default pull-right raw-margin-left-8" href="{!! url('siravel/blog/'.$blog->id.'/history') !!}">{!! trans('siravel::modules.history') !!}</a>
        @endif

        <h1 class="page-header">{!! trans('siravel::modules.blog') !!}</h1>
    </div>

    @include('siravel::modules.blogs.breadcrumbs', ['location' => ['edit']])

    <div class="row raw-margin-bottom-24">
        <ul class="nav nav-tabs">
            @foreach(config('siravel.languages', Siravel::config('siravel.languages')) as $short => $language)
                <li role="presentation" @if (request('lang') == $short || is_null(request('lang')) && $short == Siravel::config('siravel.default-language'))) class="active" @endif><a href="{{ url('siravel/blog/'.$blog->id.'/edit?lang='.$short) }}">{{ ucfirst($language) }}</a></li>
            @endforeach
        </ul>
    </div>

    <div class="row">
        <div class="@if (config('siravel.live-preview', false)) col-md-6 @endif">
            {!! Form::model($blog, ['route' => ['siravel.blog.update', $blog->id], 'method' => 'patch', 'class' => 'edit']) !!}

                <input type="hidden" name="lang" value="{{ request('lang') }}">

                <div class="form-group">
                    <label for="Template">{!! trans('siravel::modules.template') !!}</label>
                    <select class="form-control" id="Template" name="template">
                        @foreach (BlogService::getTemplatesAsOptions() as $template)
                            @if (! is_null(request('lang')) && request('lang') !== config('siravel.default-language', 'en') && $blog->translationData(request('lang')))
                                <option @if($template === $blog->translationData(request('lang'))->template) selected  @endif value="{!! $template !!}">{!! ucfirst(str_replace('-template', '', $template)) !!}</option>
                            @else
                                <option @if($template === $blog->template) selected  @endif value="{!! $template !!}">{!! ucfirst(str_replace('-template', '', $template)) !!}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                @if (! is_null(request('lang')) && request('lang') !== config('siravel.default-language', 'en'))
                    {!! FormMaker::fromObject($blog->translationData(request('lang')), Config::get('siravel.forms.blog')) !!}
                @else
                    {!! FormMaker::fromObject($blog, Config::get('siravel.forms.blog')) !!}
                @endif

                <div class="form-group text-right">
                    <a href="{!! url('siravel/blog') !!}" class="btn btn-default raw-left">{!! trans('siravel::modules.cancel') !!}</a>
                    {!! Form::submit(trans('siravel::modules.save'), ['class' => 'btn btn-primary']) !!}
                </div>

            {!! Form::close() !!}
        </div>
        @if (config('siravel.live-preview', false))
            <div class="col-md-6 hidden-sm hidden-xs">
                <div id="wrap">
                    @if (! is_null(request('lang')) && request('lang') !== config('siravel.default-language', 'en'))
                        <iframe id="frame" src="{!! url('siravel/preview/blog/'.$blog->id.'?lang='.request('lang')) !!}"></iframe>
                    @else
                        <iframe id="frame" src="{{ url('siravel/preview/blog/'.$blog->id) }}"></iframe>
                    @endif
                </div>
                <div id="frameButtons" class="raw-margin-top-16">
                    <button class="btn btn-default preview-toggle" data-platform="desktop">{!! trans('siravel::modules.desktop') !!}</button>
                    <button class="btn btn-default preview-toggle" data-platform="mobile">{!! trans('siravel::modules.mobile') !!}</button>
                </div>
            </div>
        @endif
    </div>

@endsection
