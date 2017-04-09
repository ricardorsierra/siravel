
@if (Session::has("notification"))
    siravelNotify("{{ Session::get("notification") }}", "{{ Session::get("notificationType") }}");
@endif

@if (Session::has("message"))
    siravelNotify("{{ Session::get("message") }}", "alert-info");
@endif

@if (Session::has("errors"))
    @foreach ($errors->all() as $error)
        siravelNotify("{{ $error }}", "alert-danger");
    @endforeach
@endif