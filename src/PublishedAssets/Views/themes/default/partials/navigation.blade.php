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
                @menu('main', 'siravel-frontend::partials.main-menu')
                <li><a href="{{ url('blog') }}">{!! trans('siravel::modules.blog') !!}</a></li>
                <li><a href="{{ url('gallery') }}">{!! trans('siravel::modules.gallery') !!}</a></li>
                <li><a href="{{ url('events') }}">{!! trans('siravel::modules.events') !!}</a></li>
                <li><a href="{{ url('faqs') }}">{!! trans('siravel::modules.faqs') !!}</a></li>
                @modules()
            </ul>
            <ul class="nav navbar-nav navbar-right menu">
                @if (auth()->user())
                    <li><a href="{!! url('user/settings') !!}"><span class="fa fa-user"></span> {!! trans('siravel::modules.settings') !!}</a></li>
                    <li><a href="{!! url('logout') !!}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                            <span class="fa fa-sign-out"></span>
                            {!! trans('siravel::modules.logout') !!}
                        </a>
                    </li>
                    <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                @else
                    <li><a href="{!! url('login') !!}"><span class="fa fa-sign-in"></span> {!! trans('siravel::modules.login') !!}</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
