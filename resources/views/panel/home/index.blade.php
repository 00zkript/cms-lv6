@extends('panel.template.gentella')
@section('cuerpo')


        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-uppercase text-center">BIENVENIDO {{ auth()->user()->usuario }}</h3>

                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
