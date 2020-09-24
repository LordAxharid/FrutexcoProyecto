@extends('layouts.frontLayout.front_design')
@section('content')
<?php use App\Product; ?>
<section id="cart_items">
<div class="container">
		<div class="ogami-breadcrumb">
       
          <ul>
            <li> <a class="breadcrumb-link" href=""> <i class="fas fa-home"></i>Inicio</a></li>
            <li> <a class="breadcrumb-link" href="">Ordenes</a></li>
          </ul>
        </div>
</section>

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
                      <th class="product-iamge" scope="col">Id de orden</th>
                      <th class="product-name" scope="col">Código producto</th>
                      <th class="product-price" scope="col">Método de pago</th>
                      <th class="product-quantity" scope="col">Total, a pagar</th>
                      <th class="product-total" scope="col">Creado el</th>
					
                    </tr>
                  </thead>
                  <tbody>
				 
				  @foreach($orders as $order)
                    <tr>
                     
                      <td class="product-name">{{ $order->id }}</td>
                      <td>
                      @foreach($order->orders as $pro)
                      <a href="{{ url('/orders/'.$order->id) }}">{{ $pro->product_code }}</a><br><br>
                      @endforeach
                      </td>
                    
                      <td class="product-total">{{ $order->payment_method }}</td>
                      


                      @auth
                        	<!--CLIENTE-->
                          @if(auth::user()->Cliente===1)
                          <td class="product-total">USD {{ $order->grand_total*$pro->product_qty }}$</td>
				    	@endif 
                      <!--CLIENTE NO PAGO-->
                    @if(auth::user()->Cliente===0)
                    <td class="product-total">USD $</td>
					    @endif
                     <!--VISTANTE-->
                     @else
                     <td class="product-total">USD $</td>
                     @endauth
              
                      <td class="product-total">{{ $order->created_at }}</td>
                    </tr>
					
					@endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
      
        </div>
      </div>
      <!-- End shopping cart-->

@endsection
