@extends('layouts.frontLayout.front_design')

@section('content')

<?php 
use App\Product;
use App\Gallery;
use App\Http\Controllers\Controller;
$mainCategories =  Controller::mainCategories();
$cartCount = Product::cartCount();
 ?>

<div class="shop-layout">
        <div class="container">
          <div class="row">
            <div class="col-xl-3">
              <div class="shop-sidebar">
                <button class="no-round-btn" id="filter-sidebar--closebtn">Close sidebar</button>
                <div class="shop-sidebar_department">
                  <div class="department_top mini-tab-title underline">
                    <h2 class="title">Categorias</h2>
                  </div>
                  <div class="department_bottom">
                    <ul>
					@foreach($mainCategories as $cat)
                      <li> <a class="department-link" href="{{ asset('products/'.$cat->url) }}">{{ $cat->name }}</a></li>
                      @endforeach
                    </ul>
                  </div>
                </div>
            
                <div class="shop-sidebar_color-filter">
                  <div class="color-filter_top mini-tab-title underline">
                    <h2 class="title">Colores</h2>
                  </div>
                  <div class="color-filter_bottom">
                    <div class="row">
                      <div class="col-6">
                        <div class="color">
						@include('layouts.frontLayout.front_sidebar_listing')
                        </div>
                    
                      </div>
                     
                    </div>
                  </div>
                </div>
       
             
              </div>
              <div class="filter-sidebar--background" style="display: none"></div>
            </div>
            <div class="col-xl-9">
              <div class="shop-grid-list">
                <div class="shop-products">
                  <div class="shop-products_top mini-tab-title underline">
                    <div class="row align-items-center">
                      <div class="col-6 col-xl-4">
                        <h2 class="title">Productos ({{ count($productsAll) }})</h2>
                      </div>
                      <div class="col-6 text-right">
                        <div id="show-filter-sidebar">
                          <h5> <i class="fas fa-bars"></i>Show sidebar</h5>
                        </div>
                      </div>
                      <div class="col-12 col-xl-8">
                        <div class="product-option">
                          <div class="product-filter">
                         
                          </div>
                          <div class="view-method">
                            <p class="active" id="grid-view"><i class="fas fa-th-large"></i></p>
                            <p id="list-view"><i class="fas fa-list"></i></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--Using column-->
                  </div>
				  
                  <div class="shop-products_bottom">
				  
                    <div class="row no-gutters-sm">
                    @foreach($productsAll as $pro)
                      <div class="col-6 col-md-4">
					  
                        <div class="product">
                          <div class="product-img_block"><a class="product-img" href="{{ url('/product/'.$pro->id) }}"><img src="{{ asset('/images/backend_images/product/small/'.$pro->image) }}" alt=""></a>
                           
                          </div>
                          @auth
                          	<!--CLIENTE-->
                          @if(auth::user()->Cliente===1)
                          <div class="product-info_block">
                            <h5 class="product-type">{{ $pro->product_name }}</h5>
                            <a class="product-name" href="{{ url('/product/'.$pro->id) }}">{{ $pro->product_name }}</a>
                            <h3 class="product-price">USD {{ $pro->price }}$</h3>
                            <p class="product-describe"><?php echo nl2br($pro->description); ?></p>
                          </div>
                          @endif 
                           <!--CLIENTE NO PAGO-->
                          @if(auth::user()->Cliente===0)
                          <div class="product-info_block">
                            <h5 class="product-type">{{ $pro->product_name }}</h5>
                            <a class="product-name" href="{{ url('/product/'.$pro->id) }}">{{ $pro->product_name }}</a>
                            <h3 class="product-price">USD </h3>
                            <p class="product-describe"><?php echo nl2br($pro->description); ?></p>
                          </div>
                          @endif
                     <!--VISTANTE-->
                     @else
                          <div class="product-info_block">
                            <h5 class="product-type">{{ $pro->product_name }}</h5>
                            <a class="product-name" href="{{ url('/product/'.$pro->id) }}">{{ $pro->product_name }}</a>
                            <h3 class="product-price">USD </h3>
                            <p class="product-describe"><?php echo nl2br($pro->description); ?></p>
                          </div>
                          @endauth
                          <div class="product-select">
                            <button class="add-to-wishlist round-icon-btn"> <i class="icon_heart_alt"></i></button>
                            <button class="add-to-cart round-icon-btn">  <i class="icon_bag_alt"></i></button>                       
                          </div>
                      
                        </div>
				
                      </div>
                      @endforeach
                    </div>
                    </div>
                  
                  <div class="shop-pagination">
                    <ul>
                      <li>
					  @if(empty($search_product))
                        <button class="no-round-btn smooth active">{{ $productsAll->links() }}</button>
						@endif
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End shop layout-->

@endsection
