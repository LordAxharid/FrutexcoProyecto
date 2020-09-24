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
						<font face="Cera Pro Bold"> <strong>{!! session('flash_message_error') !!}</strong></font>
		            </div>
        		@endif
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
                      <th class="product-name" scope="col">Nombre Del Producto</th>
                      <th class="product-price" scope="col">Precio</th>
                      <th class="product-quantity" scope="col">Cantidad KG</th>
                      <th class="product-total" scope="col">Precio Total</th>
					  <th class="product-total" scope="col">Agregar A Carrito</th>
					  <th class="product-total" scope="col">Eliminar Producto</th>
                    </tr>
					</thead>
					<tbody>
						<?php $total_amount = 0; ?>
						@foreach($userWishList as $wishlist)
							<tr>
								<td class="cart_product">
									<a href=""><img style="width:100px;" src="{{ asset('/images/backend_images/product/small/'.$wishlist->image) }}" alt=""></a>
								</td>
								<td class="cart_description product-name">
									<h4>{{ $wishlist->product_name }}</a></h4>
									<p>Codigo producto: {{ $wishlist->product_code }}</p>
								</td>
								<td class="product-price">
									<?php $product_price = Product::getProductPrice($wishlist->product_id,$wishlist->size); ?>
									<!--CLIENTE-->
									@auth
										@if(auth::user()->Cliente===1)
									<p>USD {{ $product_price }}$</p>
									@endif
									<!--CLIENTE NO PAGO-->
									@if(auth::user()->Cliente===0)
									<p>USD $</p>
									@endif


									@endauth

								</td>
								<td class="product-quantity">
									<p>{{ $wishlist->quantity }}</p>
								</td>
								<td class="product-total">
								<!--CLIENTE-->
								@auth
									@if(auth::user()->Cliente===1)
								 	 <p class="product-total">USD {{ $product_price*$wishlist->quantity }}$</p>
									 @endif
								<!--CLIENTE NO PAGO-->
									@if(auth::user()->Cliente===0)
								 	 <p class="product-total">USD$</p>
									@endif
								@endauth
								</td>
								<form name="addtoCartForm" id="addtoCartForm" action="{{ url('add-cart') }}" method="post">{{ csrf_field() }}
		                        <input type="hidden" name="product_id" value="{{ $wishlist->product_id }}">
		                        <input type="hidden" name="product_name" value="{{ $wishlist->product_name }}">
		                        <input type="hidden" name="product_code" value="{{ $wishlist->product_code }}">
		                        <input type="hidden" name="product_color" value="{{ $wishlist->product_color }}">
		                        <input type="hidden" name="size" value="{{ $wishlist->id }}-{{ $wishlist->size }}">
		                        <input type="hidden" name="price" id="price" value="{{ $wishlist->price }}">
								<td class="cart_delete">
									<button type="submit" class="normal-btn cart" id="cartButton" name="cartButton" value="Add to Cart">
										<i class="fa fa-shopping-cart"></i>
									</button>
								</td>
								<td>
								<a class="cart_quantity_delete normal-btn" href="{{ url('/wish-list/delete-product/'.$wishlist->id) }}"><i class="fa fa-times"></i></a>
								</td>
								</form>
							</tr>
							<?php $total_amount = $total_amount + ($product_price*$wishlist->quantity); ?>
						@endforeach

					</tbody>
				</table>
				</div>
				</div>
				</div>
				</div>
				</div>
			</div>
		</div>
</section> <!--/#Item carrito-->


@endsection
