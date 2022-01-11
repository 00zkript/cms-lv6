@extends('errors::minimal')



@section('title', __('Página prohibida'))

@section('code', '403')

@section('message', __($exception->getMessage() ?: 'Página prohibida'))

