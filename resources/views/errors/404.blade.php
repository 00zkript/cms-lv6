@extends('errors::minimal')



@section('title', __('Página no encontrada'))

@section('code', '404')

@section('message', __($exception->getMessage() ?:'Página no encontrada'))



{{-- @extends('errors::plantilla_error')



@section('title', __('PAGINA NO ENCONTRADA'))

@section('code', '404')

@section('message', __($exception->getMessage() ?:'PAGINA NO ENCONTRADA')) --}}

