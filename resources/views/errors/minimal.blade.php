@extends('web.template.plantilla')
<title>@yield('title') | IPDE</title>

@section('cuerpo')
<style type="text/css">
  .menu {
     position: relative; 
  }
  .menu-on{
    position: fixed;
  }
</style>
<div class="container fourOfour">
    <div class="row-flex justify-content-center">
        <div class="col-md-8 col-12 text-center">
            <h1>@yield('code')</h1>

            <h3 class="message text-muted">@yield('message')</h3>

            <p class="message2 text-muted"><b>Te invitamos a ir a nuestra página de inicio</b></p>
            <a href="{{url('/')}}" class="btn btn-primary mt-4 mb-5">INICIO</a>

        </div>
    </div>
</div>
@endsection