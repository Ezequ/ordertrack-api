<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Pedido #{{$order->id}} - Cliente: {{$order->id_cliente}}</h3>
            </div>
            <div class="panel-body">
                <span>Cliente: </span><span style="font-weight: bold">{{$order->id_cliente}}</span><br>
                <span>Estado: </span><span style="font-weight: bold">{{$order->id_estado}}</span><br>
                <span>Comentarios: </span><span style="font-weight: bold">{{$order->comentarios}}</span><br>
                <span>Fecha creacion: </span><span style="font-weight: bold">{{$order->created_at}}</span><br>
                <span>Fecha ultima actualizacion: </span><span style="font-weight: bold">{{$order->updated_at}}</span><br>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover tablesorter" style="table-layout: fixed;width: 100% !important;">
                <thead>
                    <tr>
                        <th>Nombre producto</th>
                        <th>Marca</th>
                        <th>Precio unitario</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>

                    </tr>
                </thead>
                <tbody>
                <?php $totalItems = 0;$totalPrice = 0; ?>
                    @foreach($products as $product)
                        <tr>
                            <?php $totalItems += $product->cantidad;$totalPrice += $product->precio * $product->cantidad; ?>
                            <th>{{$product->nombre}}</th>
                            <th>{{$product->marca}}</th>
                            <th>${{$product->precio}}</th>
                            <th>{{$product->cantidad}}</th>
                            <th>${{$product->precio * $product->cantidad}}</th>
                        </tr>
                    @endforeach
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>{{$totalItems}}</th>
                        <th>${{$totalPrice}}</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <button type="button" class="btn btn-default" data-dismiss="modal" style="float: left;">Close</button>
        <button class="btn btn-info" style="float: right" onclick="modalChangeValue()">Cambiar estado</button>
        <div class="form-group" style="float: right;margin-right: 15px">
            <select class="form-control" id="modalstate" name="modalstate" orderid="{{$order->id}}">
                @foreach(OrderStatesDefinition::getDefinition() as $code => $name)
                    <option value="{{$code}}" {{$order->id_estado == $name ? 'selected' : ''}}>{{$name}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>