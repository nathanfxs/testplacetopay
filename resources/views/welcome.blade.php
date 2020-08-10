@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header"><h1>Camiseta para Hombre</h1></div>

                <div class="card-body">
                   <div class="product">
                        <div class="product-title"></div>
                        <div class="product-media"><img src="https://camisetasurbanas.com/assets/camisetasurbanas.com/uploads/items/2/1555810453.png" class="img-fluid" /></div>
                        <div class="product-description">Camiseta para Hombre negra, 100% Algodón</div>
                        <div class="product-price">$39.900</div>
                        <div class="product-action">
                            <a href="{{ route('orders.buy',['id' => 1]) }}" class="btn btn-success"><i class="fas fa-shopping-cart"></i> Comprar</a>
                        </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection