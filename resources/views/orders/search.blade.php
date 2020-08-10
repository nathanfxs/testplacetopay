@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>Consulta el estado de tu orden:</strong></div>

                <div class="card-body">

                @if($errors->any())
                                <div class="alert alert-danger">
                                    @foreach($errors->all() as $error)
                                        - {{ $error }}<br>
                                    @endforeach
                                </div>
                            @endif
                <form action="{{ route('orders.search.view') }}" method="POST" class="form-horizontal col-lg-12">                  
                    <div class="form-row">
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
                        <div class="form-group col-lg-12">
                            <label for="customer_email">Email</label>
                            <input type="email" class="form-control" name="customer_email" id="customer_email" aria-describedby="" placeholder="Tu email" value="{{ old('customer_email') }}">
                        </div>
                        @csrf 
                        <div class="col-lg-12 text-right">
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Buscar</button>
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
