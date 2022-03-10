@extends('web.template.plantilla')

@section('titulo', '')

@section('meta')

    <meta property="og:locale" content="es_ES" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="titulo | {{ $empresaGeneral->titulo_general }}" />
    <meta property="og:description" content="{{ $empresaGeneral->seo_description }}" />
    <meta property="og:url" content="{{ request()->url() }}" />
    <meta property="og:site_name" content="{{ $empresaGeneral->titulo_general }}" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="{{ $empresaGeneral->seo_description }}" />
    <meta name="twitter:title" content="titulo | {{ $empresaGeneral->titulo_general }}" />
    <meta name="twitter:site" content="{{ '@' . $empresaGeneral->titulo_general }}" />
    <meta name="twitter:creator" content="{{ '@' . $empresaGeneral->titulo_general }}" />

@endsection

@section('css')
@endsection

@section('cuerpo')
@endsection

@push('js')
@endpush







