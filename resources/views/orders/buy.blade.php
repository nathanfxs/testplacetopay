@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>Finaliza tu compra:</strong> {{ $product['title'] }}</div>

                <div class="card-body">
                @if($errors->any())
                                <div class="alert alert-danger">
                                    @foreach($errors->all() as $error)
                                        - {{ $error }}<br>
                                    @endforeach
                                </div>
                            @endif
                <form action="{{ route('orders.store') }}" method="post" class="form-horizontal col-lg-12">                  
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="customer_name">Nombre</label>
                            <input type="text" class="form-control" name="customer_name" id="customer_name" aria-describedby="" placeholder="Tu nombre" value="{{ old('customer_name') }}" >
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="customer_last_name">Apellido</label>
                            <input type="text" class="form-control" name="customer_last_name" id="customer_last_name" aria-describedby="" placeholder="Tu apellido" value="{{ old('customer_last_name') }}">
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="customer_document_type">Tipo de identificación</label>
                            <select id="customer_document_type" name="customer_document_type" class="form-control">
                                <option value="CC" selected>CC</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-8">
                            <label for="customer_document">Número de identificación</label>
                            <input type="number" class="form-control" name="customer_document" id="customer_document" aria-describedby="" placeholder="Tu número de identificación" value="{{ old('customer_document') }}" >
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="customer_country">País</label>
                            <select name="customer_country" id="customer_country" class="form-control">
                                <option value="COL" selected>Colombia</option>
                                <option value="COL">Listado de paises...</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="customer_province">Departamento</label>
                            <select name="customer_province" id="customer_province" class="form-control">
                                <option value="Antioquia" selected>Antioquia</option>
                                <option value="Cundinamarca">Listado de departamentos...</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="customer_city">Ciudad</label>
                            <select name="customer_city" id="customer_city" class="form-control">
                                <option value="Medellin" selected>Medellín</option>
                                <option value="Bogota">Listado de ciudades...</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-8">
                            <label for="customer_street">Dirección</label>
                            <input type="text" class="form-control" name="customer_street" id="customer_street" aria-describedby="" placeholder="Tu dirección" value="{{ old('customer_street') }}" >
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="customer_postal_code">Codigo postal</label>
                            <input type="text" class="form-control" name="customer_postal_code" id="customer_postal_code" aria-describedby="" placeholder="Tu código postal" value="{{ old('customer_postal_code') }}" >
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="customer_phone">Teléfono</label>
                            <input type="text" class="form-control" name="customer_phone" id="customer_phone" aria-describedby="" placeholder="Tu número de teléfono" value="{{ old('customer_phone') }}" >
                        </div>
                        
                        <div class="form-group col-lg-6">
                            <label for="customer_mobile">Celular</label>
                            <input type="number" class="form-control" name="customer_mobile" id="customer_mobile" aria-describedby="" placeholder="Tu número de celular" value="{{ old('customer_mobile') }}">
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="customer_email">Email</label>
                            <input type="email" class="form-control" name="customer_email" id="customer_email" aria-describedby="" placeholder="Tu email" value="{{ old('customer_email') }}">
                        </div>
                        
                        <input type="hidden" class="form-control invisible" name="amount" id="amount" aria-describedby="" value="{{ $product['amount'] }}" >
                        <input type="hidden" class="form-control invisible" name="description" id="description" aria-describedby="" value="{{ $product['description'] }}" >
                        @csrf 
                        <div class="col-lg-12 text-right">
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Finalizar compra</button>
                            <a href="{{ route('welcome.index') }}" class="btn">Cancelar</a>
                        </div>
                    </div>
                 </form> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
