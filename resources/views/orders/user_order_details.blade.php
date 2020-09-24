@extends('layouts.frontLayout.front_design')
@section('content')

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
                      <th class="product-iamge" scope="col">Código producto</th>
                      <th class="product-name" scope="col">Nombre producto</th>
                      <th class="product-price" scope="col">Tipo envió</th>
                      <th class="product-quantity" scope="col">Color del producto</th>
                      <th class="product-quantity" scope="col">Precio del producto</th>
                      <th class="product-total" scope="col">Cantidad de producto KG</th>
					
                    </tr>
                  </thead>
                  <tbody>
				 
				  @foreach($orderDetails->orders as $pro)
                    <tr>
                     
                      <td class="product-name">{{ $pro->product_code }}</td>
                    
                      <td class="product-total">{{ $pro->product_name }}</td>

                      <td class="product-total">{{ $pro->product_size }}</td>
                    
                      <td class="product-total">{{ $pro->product_color }}</td>
                      @auth
                        	<!--CLIENTE-->
                          @if(auth::user()->Cliente===1)
                          <td class="product-total">USD {{ $pro->product_price*$pro->product_qty}} $</td>
				    	@endif 
                      <!--CLIENTE NO PAGO-->
                    @if(auth::user()->Cliente===0)
                    <td class="product-total">USD $</td>
					    @endif
                     <!--VISTANTE-->
                     @else
                     <td class="product-total">USD $</td>
                     @endauth

                     

                      <td class="product-total">{{ $pro->product_qty }}</td>

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

