<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Incluya lo anterior en su etiqueta HEAD ---------->

<div class="container">
    <div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title">
    			<h2>Cotizacion</h2>

                <h3 class="pull-right">Orden # {{ $orderDetails->id }}
                    <span style="float:right;"><?php echo DNS1D::getBarcodeHTML($orderDetails->id,"C39"); ?></span></h3>

    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Cotizado Por:</strong><br>
    					{{ $userDetails->name }} <br>
		                {{ $userDetails->address }} <br>
		                {{ $userDetails->city }} <br>
		                {{ $userDetails->state }} <br>
		                {{ $userDetails->country }} <br>
		                {{ $userDetails->pincode }} <br>
		                {{ $userDetails->mobile }} <br>
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
        			<strong>Envio A:</strong><br>
    					{{ $orderDetails->name }} <br>
		                {{ $orderDetails->address }} <br>
		                {{ $orderDetails->city }} <br>
		                {{ $orderDetails->state }} <br>
		                {{ $orderDetails->country }} <br>
		                {{ $orderDetails->pincode }} <br>
		                {{ $orderDetails->mobile }}
    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    					<strong>Método de pago:</strong><br>
    					{{ $orderDetails->payment_method }}
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
    					<strong>Fecha de cotizacion:</strong><br>
    					{{ $orderDetails->created_at }}<br><br>
    				</address>
    			</div>
    		</div>
    	</div>
    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Resumen de la cotizacion</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
                                <td style="width:18%"><strong>Nombre del producto</strong></td>
        							<td style="width:18%"><strong>Codigo del producto</strong></td>
        							<td style="width:18%" class="text-center"><strong>Metodo envio</strong></td>
        							<td style="width:18%" class="text-center"><strong>Color</strong></td>
        							<td style="width:18%" class="text-center"><strong>Precio</strong></td>
        							<td style="width:18%" class="text-center"><strong>Cantidad</strong></td>
        							<td style="width:18%" class="text-right"><strong>Total</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    							<!-- foreach ($order->lineItems as $line) -->
    							<?php $Subtotal = 0; ?>
    							@foreach($orderDetails->orders as $pro)
    							<tr>
                                    <td class="text-left">{{ $pro->product_name }} </td>
    								<td class="text-left">{{ $pro->product_code }} <?php echo DNS2D::getBarcodeHTML($pro->product_code, "QRCODE"); ?></td>
    								<td class="text-center">{{ $pro->product_size }}</td>
    								<td class="text-center">{{ $pro->product_color }}</td>
    								<td class="text-center">USD {{ $pro->product_price }}$</td>
    								<td class="text-center">{{ $pro->product_qty }}</td>
    								<td class="text-right">USD {{ $pro->product_price * $pro->product_qty }}$</td>
    							</tr>
    							<?php $Subtotal = $Subtotal + ($pro->product_price * $pro->product_qty); ?>
                                @endforeach
    							<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>Total</strong></td>
    								<td class="thick-line text-right">USD {{ $Subtotal }}$</td>
    							</tr>

    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>
