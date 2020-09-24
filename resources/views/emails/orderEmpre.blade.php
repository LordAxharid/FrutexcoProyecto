<html>
<body>

	<table style="max-width: 600px; padding: 10px; margin:0 auto; border-collapse: collapse;">

	<tr>
		<td style="background-color: #ecf0f1; text-align: left; padding: 0">
			<a href="">
			<img src="{{ $message->embed(public_path().'/images/frontend_images/home/FRUTEXCO.png') }}">
			</a>
		</td>
	</tr>

	<tr>
		<td style="background-color: #ecf0f1">
			<div style="color: #34495e; margin: 4% 10% 2%; text-align: justify;font-family: sans-serif">
				<h2 style="color: #e67e22; margin: 0 0 7px">Hola FRUTEXCO!!</h2>
				<p style="margin: 2px; font-size: 15px">
				    Aquí te tenemos una nueva cotización <br>
					Numero de orden: {{ $order_id }}<br>

					El cliente espera tu pronta respuesta.<br>


			<table width='95%' cellpadding="5" cellspacing="5" bgcolor="#f7f4f4">
				<tr bgcolor="#cccccc">
					<td>Nombre del producto</td>
					<td>Codigo del producto</td>
					<td>Metodo de envio</td>
					<td>Color</td>
					<td>Cantidad</td>
					<td>Precio por unidad</td>
				</tr>
				@foreach($productDetails['orders'] as $product)
					<tr>
						<td>{{ $product['product_name'] }}</td>
						<td>{{ $product['product_code'] }}</td>
						<td>{{ $product['product_size'] }}</td>
						<td>{{ $product['product_color'] }}</td>
						<td>{{ $product['product_qty'] }}</td>

						<td>USD${{ $product['product_price'] }}</td>

					</tr>
				@endforeach

				<tr>
					<td colspan="5" align="right">Gastos De Envio</td><td>USD {{ $productDetails['shipping_charges'] }} $</td>
				</tr>
				<tr>
					<td colspan="5" align="right">Cupon De Descuento</td><td>USD {{ $productDetails['coupon_amount'] }} $</td>
				</tr>
				<tr>
					<td colspan="5" align="right">Total</td><td>USD {{ $productDetails['grand_total']*$product['product_qty'] }} $</td>
				</tr>



			</table>
		</td></tr>
		<tr><td>
			<table width="100%">
				<tr>
					<td width="50%">
						<table>
							<tr>
								<td><strong>Cobrar A :-</strong></td>
							</tr>
							<tr>
								<td>{{ $userDetails['name'] }}</td>
							</tr>
							<tr>
								<td>{{ $userDetails['address'] }}</td>
							</tr>
							<tr>
								<td>{{ $userDetails['city'] }}</td>
							</tr>
							<tr>
								<td>{{ $userDetails['state'] }}</td>
							</tr>
							<tr>
								<td>{{ $userDetails['country'] }}</td>
							</tr>
							<tr>
								<td>{{ $userDetails['pincode'] }}</td>
							</tr>
							<tr>
								<td>{{ $userDetails['mobile'] }}</td>
							</tr>
						</table>
					</td>
					<td width="50%">
						<table>
							<tr>
								<td><strong>Envio A :-</strong></td>
							</tr>
							<tr>
								<td>{{ $productDetails['name'] }}</td>
							</tr>
							<tr>
								<td>{{ $productDetails['address'] }}</td>
							</tr>
							<tr>
								<td>{{ $productDetails['city'] }}</td>
							</tr>
							<tr>
								<td>{{ $productDetails['state'] }}</td>
							</tr>
							<tr>
								<td>{{ $productDetails['country'] }}</td>
							</tr>
							<tr>
								<td>{{ $productDetails['pincode'] }}</td>
							</tr>
							<tr>
								<td>{{ $productDetails['mobile'] }}</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Empresa,<br> Calidad De Frutas</td></tr>
		<tr><td>&nbsp;</td></tr>


					<br></p>
					<br>
					<br>

				<div style="width: 100%; text-align: right">
					<button style="text-decoration: none; border-radius: 5px; padding: 11px 23px; color: white; background-color: #b03a2e" >Suerte con la venta</button>
				</div>
				<p style="color: #b3b3b3; font-size: 12px; text-align: center;margin: 30px 0 0">Frutexco 2020</p>

			</div>
		</td>
	</tr>
</table>
<tr><td>&nbsp;</td></tr>
</body>
</html>
