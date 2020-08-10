@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Orden id: {{ $order->id }}</div>

                <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                    <ul class="">
                        <li><strong>Nombre</strong>: {{ $order->customer_name }}</li>
                        <li><strong>Email</strong>: {{ $order->customer_email }}</li>
                        <li><strong>Mobile</strong>: {{ $order->customer_mobile }}</li>
                        @if($order->status=='PAYED')
                            <li class="alert-success"><strong>Estado</strong>: Pagada</li>
                        @elseif($order->status=='REJECTED')
                            <li class="alert-danger"><strong>Estado</strong>: Rechazada </li>
                        @elseif($order->status=='PENDING')
                            <li class="alert-warning"><strong>Estado</strong>: Pendiente por resolver </li>    
                        @elseif($order->status=='CREATED')
                        <li><strong>Estado</strong>: Creada</li>
                        @endif
                        <li><strong>Fecha creación</strong>: {{ $order->created_at }}</li>
                        <li><strong>Fecha actualización</strong>: {{ $order->updated_at }}</li>
                    </ul>
                    @if($order->status=='CREATED')
                        <a href="{{ route('orders.payment',['id' => $order->id]) }}" class="btn btn-success"><i class="fas fa-shopping-cart"></i> Pagar</a>
                    @elseif($order->status=='REJECTED' || $order->status=='PENDING')
                    <a href="{{ route('orders.payment',['id' => $order->id]) }}" class="btn btn-success"><i class="fas fa-shopping-cart"></i> Reintentar pago</a>
                    @endif

                    <a href="{{ route('orders.index') }}">Regresar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
