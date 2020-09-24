@extends('layouts.frontLayout.front_design')
@section('content')
<?php use App\Product; ?>
<section id="cart_items">
		<div class="container">
		<div class="ogami-breadcrumb">
       
          <ul>
            <li> <a class="breadcrumb-link" href=""> <i class="fas fa-home"></i>Inicio</a></li>
            <li> <a class="breadcrumb-link" href="">Carrito</a></li>
			<li> <a class="breadcrumb-link" href="">Ingresar dirección </a></li>
            <li> <a class="breadcrumb-link active" href="">Confirmar</a></li>
          </ul>
        </div>
   
      <!-- End breadcrumb-->

			<div class="shopper-informations">
				<div class="row">
				</div>
			</div>
			<div class="row">
				@if(Session::has('flash_message_error'))
		            <div class="alert alert-error alert-block" style="background-color:#f4d2d2">
		                <button type="button" class="close" data-dismiss="alert">×</button>
						<font face="Cera Pro Bold"><strong>{!! session('flash_message_error') !!}</strong></font>
		            </div>
        		@endif
			</div>

			<div class="order-step">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="order-step_block">
                <div class="row no-gutters">
                  <div class="col-12 col-md-4">
                    <div class="step-block">
                      <div class="step">
                        <h2>Carrito de compra</h2><span>01</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-4">
                    <div class="step-block">
                      <div class="step">
                        <h2>Ingresar dirección</h2><span>02</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-4">
                    <div class="step-block active">
                      <div class="step">
                        <h2>Confirmar cotización</h2><span>03</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End order step-->
<br>
			<div class="shopping-cart">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="product-table">
                <table class="table table-responsive"> 
                  <colgroup>
                    <col span="1" style="width: 15%">
                    <col span="1" style="width: 30%">
                    <col span="1" style="width: 15%">
                    <col span="1" style="width: 15%">
                    <col span="1" style="width: 15%">
                    <col span="1" style="width: 10%">
                  </colgroup>
                  <thead>
                    <tr>
                      <th class="product-iamge" scope="col">Imagen</th>
                      <th class="product-name" scope="col">Nombre producto</th>
                      <th class="product-price" scope="col">Precio</th>
                      <th class="product-quantity" scope="col">Cantidad</th>
                      <th class="product-total" scope="col">Precio total</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php $total_amount = 0; ?>
						@foreach($userCart as $cart)
                    <tr>
                      <td class="product-iamge"> 
                        <div class="img-wrapper"><img src="{{ asset('/images/backend_images/product/small/'.$cart->image) }}" alt="product image"></div>
                      </td>
                      <td class="product-name">{{ $cart->product_name }} <br> Código de producto: {{ $cart->product_code }}</td>
					  <?php $product_price = Product::getProductPrice($cart->product_id,$cart->size); ?>
					  @auth
                          	<!--CLIENTE-->
                          @if(auth::user()->Cliente===1)
						  <td class="product-price">USD {{ $product_price }}$</td>
                        @endif 
                           <!--CLIENTE NO PAGO-->
                          @if(auth::user()->Cliente===0)
						  <td class="product-price">USD $</td>
                          @endif
                     <!--VISTANTE-->
                     @else
                     
					 <td class="product-price">USD $</td>
                     @endauth

					  <td class="product-quantity"> 
					
                        <input class="quantity no-round-input " type="number" name="quantity" min="1" value="{{ $cart->quantity }}" readonly>
						
                      </td>
					  @auth
                          	<!--CLIENTE-->
                          @if(auth::user()->Cliente===1)
                          <td class="product-total">USD$ {{ $product_price*$cart->quantity }}$</td>
                        @endif 
                           <!--CLIENTE NO PAGO-->
                          @if(auth::user()->Cliente===0)
                            <td class="product-total">USD $</td>
                          @endif
                     <!--VISTANTE-->
                     @else
                     
					 <td class="product-total">USD $</td>
                     @endauth
					  
                     
                     
                    </tr>
                 
                  </tbody>
				  <?php $total_amount = $total_amount + ($product_price*$cart->quantity); ?>
				  @endforeach
                </table>
              </div>
            </div>
       
          
          </div>
		  <div class="row">
		  <div class="col-sm-4 col-sm-offset-1">
					<div class="login-form">
					<table class="table">
					<tbody>
					<tr class="bg-warning">
					<th><font face="Cera Pro Bold">Datos de cotizante</font></th>
					</tr>
					<tr class="table-warning">
						<th><font face="Cera Pro Bold">Nombre</font></th>
						<td><font face="Cera Pro Bold">{{ $userDetails->name }}</font></td>
					</tr>
					<tr class="table-warning">
						<th><font face="Cera Pro Bold">Dirección</font></th>
						<td><font face="Cera Pro Bold">{{ $userDetails->address }}</font></td>
					</tr>
					<tr class="table-warning">
						<th><font face="Cera Pro Bold">Ciudad</font></th>
						<td><font face="Cera Pro Bold">{{ $userDetails->city }}</font></td>
					</tr>
					<tr class="table-warning">
						<th><font face="Cera Pro Bold">Estado</font></th>
						<td><font face="Cera Pro Bold">{{ $userDetails->state }}</font></td>
					</tr>
					<tr class="table-warning">
						<th><font face="Cera Pro Bold">País</font></th>
						<td><font face="Cera Pro Bold">{{ $userDetails->country }}</font></td>
					</tr>
					<tr class="table-warning">
						<th><font face="Cera Pro Bold">Código postal</font></th>
						<td><font face="Cera Pro Bold">{{ $userDetails->pincode }}</font></td>
					</tr>
					<tr class="table-warning">
						<th><font face="Cera Pro Bold">Teléfono</font></th>
						<td><font face="Cera Pro Bold">{{ $userDetails->mobile }}</font></td>
					</tr>
					</tbody>
					</table>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="signup-form">
					<table class="table">
					<tbody>
					<tr class="bg-success">
					<th><font face="Cera Pro Bold">Datos de</font><br>
					<font face="Cera Pro Bold">Envió</font></th>
					</tr>
					<tr class="table-success">
						<th><font face="Cera Pro Bold">Nombre</font></th>
						<td><font face="Cera Pro Bold">{{ $shippingDetails->name }}</font></td>
					</tr>
					<tr class="table-success">
						<th><font face="Cera Pro Bold">Dirección</font></th>
						<td><font face="Cera Pro Bold">{{ $shippingDetails->address }}</font></td>
					</tr>
					<tr class="table-success">
						<th><font face="Cera Pro Bold">Ciudad</font></th>
						<td><font face="Cera Pro Bold">{{ $shippingDetails->city }}</font></td>
					</tr>
					<tr class="table-success">
						<th><font face="Cera Pro Bold">Estado</font></th>
						<td><font face="Cera Pro Bold">{{ $shippingDetails->state }}</font></td>
					</tr>
					<tr class="table-success">
						<th><font face="Cera Pro Bold">País</font></th>
						<td><font face="Cera Pro Bold">{{ $shippingDetails->country }}</font></td>
					</tr>
					<tr class="table-success">
						<th><font face="Cera Pro Bold">Código Postal</font></th>
						<td><font face="Cera Pro Bold">{{ $shippingDetails->pincode }}</font></td>
					</tr>
					<tr class="table-success">
						<th><font face="Cera Pro Bold">Teléfono</font></th>
						<td><font face="Cera Pro Bold">{{ $shippingDetails->mobile }}</font></td>
					</tr>
					</tbody>
					</table>
					</div>
				</div>
		  <div class="col-2 col-md-6 col-lg-4">
                <div class="shopping-cart">
                  <div class="cart-total_block">
                    <table class="table">
					<tr>
					<th><font face="Cera Pro Bold">Detalles de cotización</font></th><td></td>
					</tr>
                      <colgroup>
                        <col span="1" style="width: 50%">
                        <col span="1" style="width: 50%">
                      </colgroup>
                      <tbody>
                        <tr>
						@foreach($userCart as $cart)
                          <th class="name"><font face="Cera Pro Bold">{{ $cart->product_name }}</font> × <span>{{ $cart->quantity }}</span></th>
						  @auth
                          	<!--CLIENTE-->
                          @if(auth::user()->Cliente===1)
						  <td class="price black" style="border-top: 0">USD {{ $total_amount }}$</td>
                        @endif 
                           <!--CLIENTE NO PAGO-->
                          @if(auth::user()->Cliente===0)
						  <td class="price black" style="border-top: 0">USD $</td>
                          @endif
                     <!--VISTANTE-->
                     @else
                     
					 <td class="price black" style="border-top: 0">USD $</td>
                     @endauth
					  
                        </tr>
						@endforeach
                        <tr>
                          <th>Envio</th>
                          <td>
                            <p><font face="Cera Pro Bold">Acuerdo Directo</font></p>
                          </td>
                        </tr>
                        <tr class="bg-warning">
                          <th class="text-white">TOTAL</th>
						  @auth
                          	<!--CLIENTE-->
                          @if(auth::user()->Cliente===1)
                          <td class="total text-black">USD {{ $total_amount }}$</td>
                        @endif 
                           <!--CLIENTE NO PAGO-->
                          @if(auth::user()->Cliente===0)
						  <td class="total text-black">USD $</td>
                          @endif
                     <!--VISTANTE-->
                     @else
					 <td class="total text-black">USD $</td>
                     @endauth
                         
                        </tr>
                      </tbody>
                    </table>
                  </div>
				  <form name="paymentForm" id="paymentForm" action="{{ url('/place-order') }}" method="post">{{ csrf_field() }}
				<input type="hidden" name="grand_total" value="{{ $total_amount }}"> 
                  <div class="form-group">
				  <label><input type="radio" name="payment_method" id="COD" value="COD" required> <strong><font face="Cera Pro Bold">Cotizar</font></strong></label>
                  </div>
                  
				  <button type="submit" class="normal-btn submit-btn" onclick="return selectPaymentMethod();">Hacer Orden</button>
                </div>
              </div>
			  </form>
        </div>
		</div>
      </div>
      <!-- End shopping cart-->
		
		</div>
	</section> <!--/#Item del carrito-->

@endsection
