@extends('layout')
@section('content')
    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach($products as $product)
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="https://www.cleverfiles.com/howto/wp-content/uploads/2018/03/minion.jpg">
                            <div class="card-body">
                                <h2>{{ $product->name }}</h2>
                                <p class="card-text">{{ $product->description }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button"
                                                class="btn btn-sm btn-outline-primary btnComprar"
                                                productId="{{ $product->id }}"
                                                value="{{ $product->value }}"
                                        >
                                            Comprar
                                        </button>

                                    </div>
                                    <small class="text-muted">9 mins</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Datos Compra</h5>
                </div>
                <form class="row g-3" id="formSave">
                    <div class="modal-body">
                        <div class="col-md-12">
                            <label for="validationDefault01" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="inputName" required>
                        </div>
                        <div class="col-md-12">
                            <label for="validationDefault02" class="form-label">Apellido</label>
                            <input type="text" class="form-control" id="inputLastName" required>
                        </div>
                        <div class="col-md-12">
                            <label for="validationDefault02" class="form-label">Correo</label>
                            <input type="text" class="form-control" id="inputEmail" required>
                        </div>
                        <div class="col-md-12">
                            <label for="validationDefault02" class="form-label">Telefono</label>
                            <input type="text" class="form-control" id="inputMobile"
                                   pattern="+[0,9]{2}[0,9]{10}"
                                   required placeholder="+571111111111">
                        </div>
                        <div class="col-md-12">
                            <label for="validationDefault02" class="form-label">Valor</label>
                            <input type="text" class="form-control" id="inputValue" required disabled>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btnSave" class="btn btn-primary" type="submit">Comprar</button>
                        <button type="button" class="btn btn-secondary" id="btnClose">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@stop

@section('scripts')
    <script>
        $(".btnComprar").click(function(){
            $('#btnSave').attr('productId',$(this).attr('productId'))
            $('#inputValue').val($(this).attr('value'))
            $('#modal').modal('show');
        });
        $("#btnClose").click(function(){
            $('#modal').modal('hide');
        });
        $("#formSave").submit(function (ev) {
            $.ajax({
                url: "/createOrders",
                type: 'POST',
                dataType: "json",
                data: {
                    name: $('#inputName').val(),
                    lastName: $('#inputLastName').val(),
                    email: $('#inputEmail').val(),
                    mobile: $('#inputMobile').val(),
                    productId: $('#btnSave').attr('productId'),
                    value: $('#inputValue').val(),
                    _token: $('#token').val()
                },
                success:function(result) {
                    if (!result.error){
                        window.location.href = result.url;
                    }else {
                        alert(result.mensaje);
                    }
                }
            });
            ev.preventDefault();
        });
    </script>
@stop
