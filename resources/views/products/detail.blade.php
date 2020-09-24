@extends('layouts.frontLayout.front_design')
@section('content')

<?php use App\Product; 
use App\Http\Controllers\Controller;
$mainCategories =  Controller::mainCategories();
?>
<section>
		<div class="container">
			<div class="row">
				<div class="ogami-breadcrumb">
        <div class="container">
          <ul>
            <li> <font face="Cera Pro Bold"><a class="breadcrumb-link" href="index.html"> <i class="fas fa-home"></i><?php echo $breadcrumb; ?></a></li></font>
			@if(Session::has('flash_message_success'))
	            <div class="alert alert-success alert-block">
	                 <button type="button" class="close" data-dismiss="alert">×</button>
					 <font face="Cera Pro Bold"> <strong>{!! session('flash_message_success') !!}</strong> </font>
	           </div>
	        @endif
			@if(Session::has('flash_message_error'))
	            <div class="alert alert-error alert-block" style="background-color:#d7efe5">
	                <button type="button" class="close" data-dismiss="alert">×</button>
	                   <font face="Cera Pro Bold"> <strong >{!! session('flash_message_error') !!}</strong></font>
	            </div>
	        @endif
          </ul>
        </div>
      </div>
      <!-- End breadcrumb-->
      <div class="shop-layout">
        <div class="ogami-container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="shop-detail shop-detail-fullwidth">
                <div class="row">
                  <div class="col-12 col-xl-5">
                    <div class="shop-detail_img">
                      <button class="round-icon-btn" id="zoom-btn"> <i class="icon_zoom-in_alt"></i></button>
                      <div class="row">
                        <div class="col-3">
                          <div class="slide-img" data-slick="{&quot;vertical&quot;: true}">
                            <div class="slide-img_block"><img src="{{ asset('/images/backend_images/product/medium/'.$productDetails->image) }}" alt="product image"></div>
                            @if(count($productAltImages)>0)
                            @foreach($productAltImages as $altimg)
                            <div class="slide-img_block"><img src="{{ asset('/images/backend_images/product/medium/'.$altimg->image) }}" alt="product image"></div>
                           @endforeach
                           @endif
                          </div>
                        </div>
                        <div class="col-9">
                          <div class="big-img">
                            <div class="big-img_block"><img src="{{ asset('/images/backend_images/product/small/'.$productDetails->image) }}" alt="product image"></div>

                            <div class="big-img_block"><img src="{{ asset('/images/backend_images/product/small/'.$altimg->image) }}" alt="product image"></div>
                            
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="img_control"></div>
                  </div>
                  <div class="col-12 col-xl-7">
                  <form name="addtoCartForm" id="addtoCartForm" action="{{ url('add-cart') }}" method="post">{{ csrf_field() }}
		                        <input type="hidden" name="product_id" value="{{ $productDetails->id }}">
		                        <input type="hidden" name="product_name" value="{{ $productDetails->product_name }}">
		                        <input type="hidden" name="product_code" value="{{ $productDetails->product_code }}">
		                        <input type="hidden" name="product_color" value="{{ $productDetails->product_color }}">
		                        <input type="hidden" name="price" id="price" value="{{ $productDetails->price }}">
                    <div class="row">
                      <div class="col-md-7 col-lg-7 col-xxl-8">
                        <div class="shop-detail_info">
                          <h5 class="product-type color-type">{{ $productDetails->product_name }}</h5>
                          <h2 class="product-name">{{ $productDetails->product_name }}</h2>
                     
                          <div class="product-category">
                            <h5 class="category"><font face="Cera Pro Bold">Código del producto:</font><span> <font face="Cera Pro Bold">{{ $productDetails->product_code }}</font></span></h5><br>
                            <h5 class="category"><font face="Cera Pro Bold">Color del producto :</font><span><font face="Cera Pro Bold">{{ $productDetails->product_color }}</font></span></h5><br>
                            @if(!empty($productDetails->sleeve))
                            <h5 class="category"><font face="Cera Pro Bold">Presentación caja :</font><span><font face="Cera Pro Bold">{{ $productDetails->sleeve }}</font></span></h5><br>
                            @endif
                            @if(!empty($productDetails->pattern))
                            <h5 class="category"><font face="Cera Pro Bold">Cantidades aprox por kilo :</font><span><font face="Cera Pro Bold">{{ $productDetails->pattern }}</font></span></h5><br>
                            @endif
                            <h5 class="category"><font face="Cera Pro Bold">Disponibilidad :</font><span><font face="Cera Pro Bold">@if($total_stock>0) En Stock @else Sin Stock @endif</font></span></h5><br>
                            <h5 class="category"><font face="Cera Pro Bold">Condiciones:</font><span><font face="Cera Pro Bold">Frescos</font></span></h5>
                        
                          </div>
                          
                        </div>
                      </div>
                      <div class="col-md-5 col-lg-5 col-xxl-4">
                        <div class="shop-detail_info shop-detail_info-full">
                        <font face="Cera Pro Bold"> <p class="delivery-status"><select id="selSize" name="size" style="width:150px;" required>
											    <option value="">Elegir modo de envió</option>
											    @foreach($productDetails->attributes as $sizes)
											    <option value="{{ $productDetails->id }}-{{ $sizes->size }}">{{ $sizes->size }}</option>
											    @endforeach
										     </select></font>
                         </p>

                         @auth
                          	<!--CLIENTE-->
                          @if(auth::user()->Cliente===1)
                          <div class="price-rate">
                            <h3 class="product-price"> 
                            <font face="Cera Pro Bold">USD {{ $productDetails->price }} $</font>
                            </h3>
                          </div>
                          @endif 
                           <!--CLIENTE NO PAGO-->
                          @if(auth::user()->Cliente===0)
                          <div class="price-rate">
                            <h3 class="product-price"> 
                            <font face="Cera Pro Bold">USD $</font>
                            </h3>
                          </div>
                          @endif
                     <!--VISTANTE-->
                     @else
                     <div class="price-rate">
                            <h3 class="product-price"> 
                            <font face="Cera Pro Bold">USD $</font>
                            </h3>
                          </div>  
                     @endauth
                          <div class="quantity-select">
                            <label for="quantity"><font face="Cera Pro Bold">Cantidad:</font></label>
                            <font face="Cera Pro Bold"><input name="quantity" class="no-round-input" id="quantity" type="number" min="1" value="3"></font>
                          </div>
                          <div class="product-select">

                      @if($total_stock>0)
											<button type="submit" class="add-to-cart normal-btn outline" id="cartButton" name="cartButton" value="Shopping Cart">
												<i class="fa fa-shopping-cart"></i>
												Agregar a el carrito
											</button>
								    
                    <p><button type="submit" class="add-to-cart normal-btn outline" id="WishListButton" name="wishListButton" value="Wish List">
											<i class="fa fa-briefcase"></i>
											Agregar a la lista de favoritos
										</button></p>
                    @endif
                          </div>
                         
                          @if($total_stock==0)
                    <p><label  class="add-to-cart normal-btn outline" id="WishListButton"  value="Fuera Stock">
											<i class="fa fa-briefcase"></i>
										   Producto <br>fuera de stock!!
										</label></p>
                    @endif
                    
                          <div class="product-guarante">
                            <p class="guarante"><font face="Cera Pro Bold">Satisfacción a el 100%</font></p>
                            <p class="guarante"><font face="Cera Pro Bold">Envíos seguros</font></p>
                            <p class="guarante"><font face="Cera Pro Bold">Atención al cliente</font></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="shop-detail_more-info">
                      <div id="tab-so3">
                        <ul class="mb-0">
                          <li class="active"><a href="#tab-1">Descripción</a></li>
                          <li><a href="#tab-2">Cuidados</a></li>
                          <li> <a href="#tab-3">Envíos</a></li>
                        </ul>
                        <div id="tab-1">
                          <div class="description-block">
                            <div class="description-item_block">
                              <div class="row align-items-center justify-content-around">
                                <div class="col-12 col-md-4">
                                  <div class="description-item_img"><img class="img-fluid" src="{{ asset('/images/backend_images/product/medium/'.$productDetails->image) }}" alt="description image"></div>
                                </div>
                                <div class="col-12 col-md-6">
                                  <div class="description-item_text">
                                    <h2>Información del producto</h2>
                                    <p><font face="Cera Pro Bold"><?php echo nl2br($productDetails->description); ?></font></p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div id="tab-2">
                          <div class="specifications_block">
                            <table class="shop_attributes table-bordered">
                              <tbody>
                                <tr>
                                  <th>Cuidados</th>
                                  <td class="product_weight"><font face="Cera Pro Bold"><?php echo nl2br($productDetails->care); ?></font></td>
                                </tr>
                              
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <div id="tab-3"> 
                          <div class="customer-reviews_block">
                            <div class="customer-review">
                              <div class="row">
                                <div class="col-12 col-sm-3 col-lg-2 col-xxl-1">
                                 
                                </div>
                            
                              </div>
                            </div>
                            <div class="customer-review">
                              <div class="row">
                                <div class="col-12 col-sm-3 col-lg-2 col-xxl-1">
                                  <div class="customer-review_left">
                            
                                    
                                  </div>
                                </div>
                                <div class="col-12 col-sm-9 col-lg-10 col-xxl-11">
                                  <div class="customer-comment"> 
                                
                                    <p class="customer-commented"><p><font face="Cera Pro Bold">100% Envíos seguros</font><br><br>
                                    <font face="Cera Pro Bold">Métodos de envío y términos de pago contactando directamente con el empresario</font></p>
                                  </div>
                                </div>
                              </div>
                            </div>
                        
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="related-product">
                <div class="related-product_top mini-tab-title underline">
                  <h2 class="title">Productos Relacionados</h2>
                </div>
                <?php $count=1; ?>
                  @foreach($relatedProducts->chunk(6) as $chunk)
								<div <?php if($count==1){ ?> class="item active" <?php } else { ?> class="item" <?php } ?>>
								
                <div class="related-product_bottom">
              
                  <div class="row no-gutters-sm">
                  @foreach($chunk as $item)
                    <div class="col-6 col-md-4 col-lg-3 col-xxl-2">
                      <div class="product"><a class="product-img" href="{{ url('/product/'.$item->id) }}"><img src="{{ asset('images/backend_images/product/small/'.$item->image) }}" alt=""></a>
                        <h5 class="product-type"><font face="Cera Pro Bold">{{ $item->product_name }}</font></h5>
                        <h3 class="product-name"><font face="Cera Pro Bold">{{ $item->product_name }}</font></h3>
                        @auth
                          	<!--CLIENTE-->
                          @if(auth::user()->Cliente===1)
                        <h3 class="product-price"><font face="Cera Pro Bold">USD {{ $item->price }}$</font>
                        @endif 
                           <!--CLIENTE NO PAGO-->
                          @if(auth::user()->Cliente===0)
                          <h3 class="product-price"><font face="Cera Pro Bold">USD $</font>
                          @endif
                     <!--VISTANTE-->
                     @else
                     <h3 class="product-price"><font face="Cera Pro Bold">USD $</font>
                     @endauth
                        </h3>
                        <div class="product-select">
                          <button class="add-to-wishlist round-icon-btn"><a href="{{ url('/product/'.$item->id) }}"><i class="icon_heart_alt"></i></a></button>
                          <button class="add-to-cart round-icon-btn"><a href="{{ url('/product/'.$item->id) }}"><i class="icon_bag_alt"></i></a></button>
                        </div>
                      </div>
                    </div>
                   
                    @endforeach
                  </div>
               
                  <?php $count++; ?>
								@endforeach
             
                </div>
              
              </div>
           
            </div>
         
          </div>
     
        </div>
        
      </div>
      
      <!-- End shop layout-->
     
	</section>

@endsection
