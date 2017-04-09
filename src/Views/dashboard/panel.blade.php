<ul class="nav nav-sidebar">
    <li class="@if (Request::is('siravel/dashboard')) active @endif">
        <a href="{!! url('siravel/dashboard') !!}"><span class="fa fa-fw fa-dashboard"></span> {!! trans('siravel::modules.dashboard') !!}</a>
    </li>

    <li class="@if (Request::is('siravel/help')) active @endif">
        <a href="{!! url('siravel/help') !!}"><span class="fa fa-fw fa-info-circle"></span> {!! trans('siravel::modules.help') !!}</a>
    </li>

    @if (Route::get('user/settings'))
        <li class="@if (Request::is('user/settings') || Request::is('user/password')) active @endif">
            <a href="{!! url('user/settings') !!}"><span class="fa fa-fw fa-gear"></span> {!! trans('siravel::modules.settings') !!}</a>
        </li>
    @endif

    @if (in_array('images', Config::get('siravel.active-core-modules', Siravel::defaultModules())))
        <li class="@if (Request::is('siravel/images') || Request::is('siravel/images/*')) active @endif">
            <a href="{!! url('siravel/images') !!}"><span class="fa fa-fw fa-image"></span> {!! trans('siravel::modules.images') !!}</a>
        </li>
    @endif

    @if (in_array('files', Config::get('siravel.active-core-modules', Siravel::defaultModules())))
        <li class="@if (Request::is('siravel/files') || Request::is('siravel/files/*')) active @endif">
            <a href="{!! url('siravel/files') !!}"><span class="fa fa-fw fa-file"></span> {!! trans('siravel::modules.files') !!}</a>
        </li>
    @endif

    @if (in_array('menus', Config::get('siravel.active-core-modules', Siravel::defaultModules())))
        <li class="@if (Request::is('siravel/menus') || Request::is('siravel/menus/*') || Request::is('siravel/links') || Request::is('siravel/links/*')) active @endif">
            <a href="{!! url('siravel/menus') !!}"><span class="fa fa-fw fa-link"></span> {!! trans('siravel::modules.menus') !!}</a>
        </li>
    @endif

    @if (in_array('widgets', Config::get('siravel.active-core-modules', Siravel::defaultModules())))
        <li class="@if (Request::is('siravel/widgets') || Request::is('siravel/widgets/*')) active @endif">
            <a href="{!! url('siravel/widgets') !!}"><span class="fa fa-fw fa-gear"></span> {!! trans('siravel::modules.widgets') !!}</a>
        </li>
    @endif

    @if (in_array('blog', Config::get('siravel.active-core-modules', Siravel::defaultModules())))
        <li class="@if (Request::is('siravel/blog') || Request::is('siravel/blog/*')) active @endif">
            <a href="{!! url('siravel/blog') !!}"><span class="fa fa-fw fa-pencil"></span> {!! trans('siravel::modules.blog') !!}</a>
        </li>
    @endif

    @if (in_array('pages', Config::get('siravel.active-core-modules', Siravel::defaultModules())))
        <li class="@if (Request::is('siravel/pages') || Request::is('siravel/pages/*')) active @endif">
            <a href="{!! url('siravel/pages') !!}"><span class="fa fa-fw fa-file-text-o"></span> {!! trans('siravel::modules.pages') !!}</a>
        </li>
    @endif

    @if (in_array('faqs', Config::get('siravel.active-core-modules', Siravel::defaultModules())))
        <li class="@if (Request::is('siravel/faqs') || Request::is('siravel/faqs/*')) active @endif">
            <a href="{!! url('siravel/faqs') !!}"><span class="fa fa-fw fa-question"></span> {!! trans('siravel::modules.faqs') !!}</a>
        </li>
    @endif

    @if (in_array('events', Config::get('siravel.active-core-modules', Siravel::defaultModules())))
        <li class="@if (Request::is('siravel/events') || Request::is('siravel/events/*')) active @endif">
            <a href="{!! url('siravel/events') !!}"><span class="fa fa-fw fa-calendar"></span> {!! trans('siravel::modules.events') !!}</a>
        </li>
    @endif

    {!! ModuleService::menus() !!}

    {!! Siravel::packageMenus() !!}

    @if (Route::get('admin/users')) <li class="sidebar-header"><span>{!! trans('siravel::modules.admin') !!}</span></li> @endif

    @if (Route::get('admin/users'))
        <li class="@if (Request::is('admin/users') || Request::is('admin/users/*')) active @endif">
            <a href="{!! url('admin/users') !!}"><span class="fa fa-fw fa-users"></span> {!! trans('siravel::modules.users') !!}</a>
        </li>
    @endif
    @if (Route::get('admin/roles'))
        <li class="@if (Request::is('admin/roles') || Request::is('admin/roles/*')) active @endif">
            <a href="{!! url('admin/roles') !!}"><span class="fa fa-fw fa-lock"></span> {!! trans('siravel::modules.roles') !!}</a>
        </li>
    @endif
</ul>
