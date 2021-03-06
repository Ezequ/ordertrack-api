
<div class="modal-body card">

    <div class="card-body">

        <div>
            <div class="sub-title">Información del pedido</div>
            <div>
                <span class="col-sm-3 col-md-3"><b>N° Pedido:</b></span> <span>{{$order->id}}</span><br>
                <span class="col-sm-3 col-md-3"><b>Cliente:</b></span> <span>{{$order->id_cliente}}</span><br>
                <span class="col-sm-3 col-md-3"><b>Estado:</b></span> <span>{{$order->id_estado}}</span><br>
                <span class="col-sm-3 col-md-3"><b>Comentarios:</b></span> <span>{{$order->comentarios}}</span><br>
                <span class="col-sm-3 col-md-3"><b>Fecha de confirmación:</b></span> <span>{{DatesHelper::todmytime($order->fecha_confirmacion)}}</span><br>
            </div>
        </div>
        <div style="margin-top: 20px;">
            <div class="sub-title">Listado de productos</div>
            <div class="table-responsive">
                <table class="table table-striped table-hover tablesorter" style="table-layout: fixed;width: 100% !important;">
                    <thead>
                        <tr>
                            <th class="text-center">Código</th>
                            <th>Nombre producto</th>
                            <th>Marca</th>
                            <th class="text-center">Precio unitario</th>
                            <th class="text-center">Cantidad pedida</th>
                            <th class="text-center">Subtotal sin descuento</th>
                            <th class="text-center">Descuento</th>
                            <th class="text-center">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $totalItems = 0;$totalPrice = 0;$discountedTotalPrice=0;$totalDiscount = 0; ?>
                        @foreach($products as $product)
                            <tr>
                                <?php $totalItems += $product->cantidad;
                                $totalPrice += $product->subtotal_con_descuento;
                                $discountedTotalPrice += $product->subtotal_sin_descuento;
                                $totalDiscount += $product->descuento_realizado;
                                ?>
                                <th class="text-center">{{$product->id}}</th>
                                <th>{{$product->nombre}}</th>
                                <th>{{$product->marca}}</th>
                                <th class="text-center">${{PriceHelper::getPrice($product->precio)}}</th>
                                <th class="text-center">{{$product->cantidad}}</th>
                                <th class="text-center">${{PriceHelper::getPrice($product->subtotal_sin_descuento)}}</th>
                                <th class="text-center">${{PriceHelper::getPrice($product->descuento_realizado)}}</th>
                                <th class="text-center">${{PriceHelper::getPrice($product->subtotal_con_descuento)}}</th>
                            </tr>
                        @endforeach
                        <tr style="border-top: 2px solid #ddd !important;">
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th class="text-center" style="font-size: 1.5em">{{$totalItems}}</th>
                            <th class="text-center" style="font-size: 1em">${{PriceHelper::getPrice($discountedTotalPrice)}}</th>
                            <th class="text-center" style="font-size: 1em">${{PriceHelper::getPrice($totalDiscount)}}</th>
                            <th class="text-center" style="font-size: 1.5em">${{PriceHelper::getPrice($totalPrice)}}</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@if(!Auth::user()->isSeller())
    <div class="modal-footer">
    <?php $definition = OrderStatesDefinition::getDefinition(); ?>
    <button type="button" class="btn btn-default" data-dismiss="modal" style="float: left;">Cerrar</button>
    @if($order->id_estado != $definition[Order::SHIPPING_STATE] && $order->id_estado != $definition[Order::CANCELED_STATE])
    <button class="btn btn-info" style="float: right;margin-top: 0px;" onclick="modalChangeValue()">Cambiar estado</button>
    <div class="form-group" style="float: right;margin-right: 15px">
        <select class="form-control" id="modalstate" name="modalstate" orderid="{{$order->id}}">
            <?php $previousData = $order->getStateButton();
            $nextData = $order->getStateButton(false);
            $states[$nextData['id_estado']] = $nextData['nombre'];
            $states[$previousData['id_estado']] = $previousData['nombre'];
            ?>
            @foreach($states as $code => $name)
                <option value="{{$code}}" {{$order->id_estado == $name ? 'selected' : ''}}>{{$name}}</option>
            @endforeach
        </select>
    </div>
    @endif
</div>
@endif





