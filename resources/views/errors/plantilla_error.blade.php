{{-- @extends('errors::minimal') --}}

@extends('web.template.plantilla')



{{-- @section('title', __('No encontrada '))

@section('code', '404')

@section('message', __($exception->getMessage() ?:'Not Found')) --}}











@section('titulo', html_entity_decode('&raquo;').' No encontrado')



@section('cuerpo')


<style type="text/css">
  .menu {
     position: relative; 
  }
  .menu-on{
    position: fixed;
  }
</style>



  <div class="content fourOfour">
    <div class="row-flex justify-content-center">
      <div class="col-md-8 col-12 text-center">
        <h1>@yield('code')</h1>

        <hr class="dots" />

        <h3 class="message">@yield('message','PAGINA NO ENCONTRADA') </h3>

        <p class="message2">@yield('message2', "Esta página no existe o ha sido eliminada") </p>
      </div>
    </div>

  </div>

@endsection

























