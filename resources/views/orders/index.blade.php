@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Listado de ordenes</div>

                <div class="card-body">
                    <TABLE class="table">
                            <thead>
                                <tr>
                                    <th>ID Orden</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Estado</th>
                                    <th>Fecha creado</th>
                                    <th>Fecha actualizado</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td><a href="{{ route('orders.view',['id' =>  $order->id]) }}">{{ $order->id }}</a></td>  
                                    <td>{{ $order->customer_name }}</td>
                                    <td>{{ $order->customer_email }}</td>
                                    @if($order->status=='PAYED')
                                        <td class="alert-success">Pagado</td>
                                    @elseif($order->status=='REJECTED')
                                        <td class="alert-danger">Rechazado</td>
                                    @elseif($order->status=='PENDING')
                                        <td class="alert-warning">Pendiente</td>   
                                    @else
                                        <td>Creado</td>
                                    @endif
                                    <td>{{ $order->created_at }}</td>
                                    <td>{{ $order->updated_at }}</td>
                                
                                </tr>
                                @endforeach
                            </tbody>
                        </TABLE>
                        {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
