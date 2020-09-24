@extends('layouts.frontLayout.front_design')
@section('content')
<?php use App\Product; ?>
<section id="cart_items">
<div class="ogami-breadcrumb">
        <div class="container">
          <ul>
            <li> <a class="breadcrumb-link" > <i class="fas fa-home"></i>Inicio</a></li>
            <li> <a class="breadcrumb-link" >Carrito De Compra</a></li>
          </ul>
        </div>
      </div>
			<div class="table-responsive cart_info">
				@if(Session::has('flash_message_success'))
		            <div class="alert alert-success alert-block">
		                <button type="button" class="close" data-dismiss="alert">×</button>
                    <font face="Cera Pro Bold"><strong>{!! session('flash_message_success') !!}</strong></font>
		            </div>
		        @endif
		        @if(Session::has('flash_message_error'))
		            <div class="alert alert-error alert-block" style="background-color:#f4d2d2">
		                <button type="button" class="close" data-dismiss="alert">×</button>
                    <font face="Cera Pro Bold"><strong>{!! session('flash_message_error') !!}</strong></font>
		            </div>
        		@endif
				</section>

		<div class="order-step">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="order-step_block">
                <div class="row no-gutters">
                  <div class="col-12 col-md-4">
                    <div class="step-block active">
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
                    <div class="step-block">
                      <div class="step" >
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
                      <th class="product-name" scope="col">Nombre del producto</th>
                      <th class="product-price" scope="col">Precio</th>
                      <th class="product-quantity" scope="col">Cantidad KG</th>
                      <th class="product-total" scope="col">Precio Total</th>
					  <th class="product-total" scope="col">Eliminar Producto</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php $total_amount = 0; ?>
				  @foreach($userCart as $cart)
                    <tr>
                      <td class="product-iamge"> 
                        <div class="img-wrapper"><img src="{{ asset('/images/backend_images/product/small/'.$cart->image) }}" alt="product image"></div>
                      </td>
                      <td class="product-name">{{ $cart->product_name }} <br>Codigo Producto {{ $cart->product_code }}</td>
                      <?php $product_price = Product::getProductPrice($cart->product_id,$cart->size); ?>
                      @auth
                        	<!--CLIENTE-->
                          @if(auth::user()->Cliente===1)
                      <td class="product-total">USD {{ $product_price }}$</td>
                      @endif 
                      <!--CLIENTE NO PAGO-->
                    @if(auth::user()->Cliente===0)
                    <td class="product-total">USD $</td>
                    @endif
                     <!--VISTANTE-->
                     @else
                     <td class="product-total">USD $</td>
                     @endauth
                      <td class="product-quantity"> 
					  <a class="cart_quantity_up" href="{{ url('/cart/update-quantity/'.$cart->id.'/1') }}"> + </a>
                        <input class="quantity no-round-input " type="number" name="quantity" min="1" value="{{ $cart->quantity }}" readonly>
						@if($cart->quantity>1)
						<a class="cart_quantity_down" href="{{ url('/cart/update-quantity/'.$cart->id.'/-1') }}"> - </a>
						@endif
                      </td>
                      @auth
                        	<!--CLIENTE-->
                          @if(auth::user()->Cliente===1)
                      <td class="product-total">USD {{ $product_price*$cart->quantity }}$</td>
                      @endif 
                      <!--CLIENTE NO PAGO-->
                    @if(auth::user()->Cliente===0)
                    <td class="product-total">USD $</td>
                    @endif
                     <!--VISTANTE-->
                     @else
                     <td class="product-total">USD $</td>
                     @endauth

                      <td class="product-clear"> 
                        <a class="no-round-btn"  href="{{ url('/cart/delete-product/'.$cart->id) }}"><i class="icon_close"></i></a>
                      </td>
                    </tr>
					<?php $total_amount = $total_amount + ($product_price*$cart->quantity); ?>
					@endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="row justify-content-end">
            <div class="col-12 col-md-6 col-lg-4">
              <div class="cart-total_block">
                <h2>Total Del Carrito</h2>
                <table class="table">
                  <colgroup>
                    <col span="1" style="width: 50%">
                    <col span="1" style="width: 50%">
                  </colgroup>
                  <tbody>
                    <tr>
                      <th>Envio</th>
                      <td>
                        <p>Acuerdo Directo</p>
                       
                      </td>
                    </tr>
                    <tr>
                    <th>Precio Total</th>
                    @auth
                        	<!--CLIENTE-->
                          @if(auth::user()->Cliente===1)
                          <td>USD <?php echo $total_amount; ?>$</td>
                      @endif 
                      <!--CLIENTE NO PAGO-->
                    @if(auth::user()->Cliente===0)
                    <td>USD $</td>
                    @endif
                     <!--VISTANTE-->
                     @else
                     <td>USD $</td>
                     @endauth
                    </tr>
                  </tbody>
                </table>
                <div class="checkout-method">
                  <a class="normal-btn text-white" href="{{ url('/checkout') }}">Ingresar Dirección</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End shopping cart-->
@endsection
