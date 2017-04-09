<h1>{!! trans('siravel::modules.welcome') !!} {{ $user->email }}</h1>

<p>{!! trans('siravel::modules.infoNewAccount') !!}</p>

<p>{!! trans('siravel::modules.email') !!}: {{ $user->email }}</p>
<p>{!! trans('siravel::modules.password') !!}: {{ $password }}</p>

<p>{!! trans('siravel::modules.goToLogin') !!}: <a href="{{ url('login') }}">{!! trans('siravel::modules.login') !!}</a></p>