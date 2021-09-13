@extends('layout')
@section('content')
    <br>
    <div>Ordenes<hr></div>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Correo</th>
            <th scope="col">Telefono</th>
            <th scope="col">Valor</th>
            <th scope="col">Estado</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>
                        {{ $order->id }}
                    </td>
                    <td>
                        {{ $order->customer_name }}
                    </td>
                    <td>
                        {{ $order->customer_email }}
                    </td>
                    <td>
                        {{ $order->customer_mobile }}
                    </td>
                    <td>
                        {{ $order->total }}
                    </td>
                    <td>
                        {{ __('status.status.'.$order->status) }}
                    </td>
                    <td>
                        <a href="{{ URL::to('/order/'.$order->id) }}">Ver</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
