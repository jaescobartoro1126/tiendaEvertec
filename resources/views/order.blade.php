@extends('layout')
@section('content')
    <br>
    <div>Orden<hr></div>
    <div>
        <div class="col-md-12">
            <label for="validationDefault01" class="form-label">Orden</label>
            <input type="text" class="form-control" id="inputName" disabled value="{{ $order->id }}">
        </div>
        <div class="col-md-12">
            <label for="validationDefault01" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="inputName" disabled value="{{ $order->customer_name }}">
        </div>
        <div class="col-md-12">
            <label for="validationDefault02" class="form-label">Correo</label>
            <input type="text" class="form-control" id="inputEmail" disabled value="{{ $order->customer_email }}">
        </div>
        <div class="col-md-12">
            <label for="validationDefault02" class="form-label">Telefono</label>
            <input type="text" class="form-control" id="inputMobile"
                   disabled value="{{ $order->customer_mobile }}">
        </div>
        <div class="col-md-12">
            <label for="validationDefault02" class="form-label">Valor</label>
            <input type="text" class="form-control" id="inputValue" disabled value="{{ $order->total }}">
        </div>
        <div class="col-md-12">
            <label for="validationDefault02" class="form-label">Estado</label>
            <input type="text" class="form-control" id="inputValue" disabled value="{{ __('status.status.'.$order->status) }}">
        </div>
        <br>
        <div class="col-md-12">
            @if($order->status !== 'PAYED')
                <button id="btnPay" class="btn btn-primary" type="button" order="{{ $order->id }}">Pagar</button>
            @endif
            <button type="button" class="btn btn-secondary" id="btnBack">Regresar</button>
        </div>
    </div>
@stop
@section('scripts')
    <script>
        $("#btnBack").click(function(){
            window.location.href = "{{ URL::to('/orders/') }}";
        });
        $("#btnPay").click(function(){
            $.ajax({
                url: "/orderPay/"+$(this).attr('order'),
                type: 'POST',
                success:function(result) {
                    if (!result.error){
                        window.location.href = result.url;
                    }else {
                        alert(result.mensaje);
                    }
                }
            });
        });
    </script>
@stop
