<nav class="navbar navbar-default navbar-fixed-top clearfix">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navBar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('') }}">{!! trans('siravel::modules.home') !!}</a>
        </div>
        <div class="collapse navbar-collapse" id="navBar">
            <ul class="nav navbar-nav">
                <li><a href="{{ url('page/welcome') }}">{!! trans('siravel::modules.welcome') !!}</a></li>
                <li><a href="{{ url('blog') }}">{!! trans('siravel::modules.blog') !!}</a></li>
                <li><a href="{{ url('gallery') }}">{!! trans('siravel::modules.gallery') !!}</a></li>
                <li><a href="{{ url('faqs') }}">{!! trans('siravel::modules.faqs') !!}</a></li>
                <li><a href="{{ url('events') }}">{!! trans('siravel::modules.events') !!}</a></li>
                @modules()
            </ul>
            <ul class="nav navbar-nav navbar-right menu">
                @if (config('app.locale') == 'fr')
                    @menu('main-fr')
                @else
                    @menu('main')
                @endif
            </ul>
        </div>
    </div>
</nav>