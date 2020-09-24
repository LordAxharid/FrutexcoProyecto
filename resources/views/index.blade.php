@extends('layouts.frontLayout.front_design')

@section('content')

<div class="slider slider_v2">
        <div class="full-fluid">
          <div class="slider_wrapper">
          @foreach($banners as $key => $banner)
            <div class="slider-block" style="background-image: url('images/frontend_images/banners/{{ $banner->image }}')">
              <div class="slider-content"> 
                <div class="container">
                  <div class="row align-items-center">
                    <div class="col-12">
                      <div class="slider-text d-flex flex-column align-items-center">
                        <div class="slider_img" data-animation="fadeInUp" data-delay=".4s"><img src="{{ asset('images/frontend_images/banners/banner.png') }}" alt="">
                        </div>
                        <a class="normal-btn coffee" href="{{ $banner->link }}" data-animation="fadeInUp" data-delay=".4s">Ir ahora</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
      <!-- End slider-->
<section>
 
<div class="benefit-block">
            <div class="container">
              <div class="our-benefits">
                <div class="row">
                  <div class="col-12 col-md-4">
                    <div class="benefit-detail d-flex flex-column align-items-center"><img class="benefit-img" src="{{ asset('images/frontend_images/homepage01/benefit-icon1.png') }}" alt="">
                      <h5 class="benefit-title">Envíos seguros</h5>
                      <p class="benefit-describle">Nuestros envíos son 100% seguros</p>
                    </div>
                  </div>
                  <div class="col-12 col-md-4">
                    <div class="benefit-detail d-flex flex-column align-items-center"><img class="benefit-img" src="{{ asset('images/frontend_images/homepage01/benefit-icon4.png') }}" alt="">
                      <h5 class="benefit-title">Asesoria</h5>
                      <p class="benefit-describle">Estamos siempre atentos a nuestros clientes</p>
                    </div>
                  </div>
                  <div class="col-12 col-md-4">
                    <div class="benefit-detail boderless d-flex flex-column align-items-center"><img class="benefit-img" src="{{ asset('images/frontend_images/homepage01/benefit-icon3.png') }}" alt="">
                      <h5 class="benefit-title">Cotizaciones</h5>
                      <p class="benefit-describle">Realizamos cotizaciones</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
		</section>

        <br>
<!-- Fin Iconos Garantias -->

<section>
<div class="home3-product-block">
        <div class="container">
          <div class="row">
       
            <div class="col-12 col-xl-3">
              <div class="deal-of-week_slide">
                <div class="week-deal_top mini-tab-title underline pink">
                  <h1 class="title">Últimos Productos</h1>
               
                  <div class="week-deal_control"></div>
                </div>
               
                <div class="week-deal_bottom">
                @foreach($productsUltimate as $ultimosproductos)
                  <div class="deal-block"> 
                    <div class="deal-block_detail">
                      <h5 class="deal-discount"><font face="Cera Pro Bold">Novedades!</font></h5>
                      <div class="deal-img"><a href="{{ url('/product/'.$ultimosproductos->id) }}"><img src="{{ asset('/images/backend_images/product/medium/'.$ultimosproductos->image) }}" alt="product image"></a></div>
                      @auth
                      @if(auth::user()->Cliente===1)
                      <div class="deal-info text-center">
                        <h5 class="color-type pink deal-type"><font face="Cera Pro Bold">{{ $ultimosproductos->product_name }}</font></h5><a class="deal-name" href="{{ url('/product/'.$ultimosproductos->id) }}"><font face="Cera Pro Bold">{{ $ultimosproductos->product_name }}</font></a>
                        <h3 class="deal-price"><font face="Cera Pro Bold"> USD {{ $ultimosproductos->price }} $</font>
                        @endif 
                        @if(auth::user()->Cliente===0)
                        <div class="deal-info text-center">
                        <h5 class="color-type pink deal-type"><font face="Cera Pro Bold">{{ $ultimosproductos->product_name }}</font></h5><a class="deal-name" href="{{ url('/product/'.$ultimosproductos->id) }}"><font face="Cera Pro Bold">{{ $ultimosproductos->product_name }}</font></a>
                        <h3 class="deal-price"><font face="Cera Pro Bold"> USD$</font>
                        @endif 
                        @else
                        <div class="deal-info text-center">
                        <h5 class="color-type pink deal-type"><font face="Cera Pro Bold">{{ $ultimosproductos->product_name }}</font></h5><a class="deal-name" href="{{ url('/product/'.$ultimosproductos->id) }}"><font face="Cera Pro Bold">{{ $ultimosproductos->product_name }}</font></a>
                        <h3 class="deal-price"><font face="Cera Pro Bold"> USD$</font>
                        @endauth
                       
                        </h3>
                      </div>
                      <div class="deal-select text-center">
                        <button class="add-to-wishlist round-icon-btn pink"><a href="{{ url('/product/'.$ultimosproductos->id) }}"><i class="icon_heart_alt"></a></i></button>
                        <button class="add-to-cart round-icon-btn pink pink"><a href="{{ url('/product/'.$ultimosproductos->id) }}"><i class="icon_bag_alt"></a></i></button> 
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
          
              </div>
         
            </div>
         
<!--ACA EMPIEZAN LOS PRODUCTOS-->
            <div class="col-12 col-xl-9">
              <div id="tab">
                <div class="best-seller_top mini-tab-title underline pink">
                  <div class="row align-items-md-center">
                    <div class="col-12 col-md-4 text-center">
                    <h1 class="title mx-auto">Productos destacados</h1>
                    </div>
                   
                  </div>
                </div>
               
            <div class="col-12">
                <div id="tab-1">
                  <div class="row no-gutters-sm">
    
                  @foreach($productsAll as $pro)<div style="color: #fe980f;">⠀⠀⠀⠀⠀⠀</div>
				  
                    <div class="col-12 col-md-4 col-lg-3">
                      <div class="product"><a class="product-img" href="{{ url('/product/'.$pro->id) }}"><img src="{{ asset('/images/backend_images/product/small/'.$pro->image) }}" alt=""></a>
                     
                        <h5 class="product-type"></h5>
                        @auth
                        	<!--CLIENTE-->
                          @if(auth::user()->Cliente===1)
                        <h3 class="product-name"><font face="Cera Pro Bold">{{ $pro->product_name }}</font></h3>
                        <h3 class="product-price"><font face="Cera Pro Bold">USD {{ $pro->price}} $ </font></h3>
                        <div class="product-select">
                          <button class="add-to-wishlist round-icon-btn"><a href="{{ url('/product/'.$pro->id) }}"> <i class="icon_heart_alt"></a></i></button>
                          <button class="add-to-compare round-icon-btn"><a href="{{ url('/product/'.$pro->id) }}"><i class="icon_cart_alt"></a></i></button>
                        
                         
                        </div>
                      </div>
                    </div>
					@endif 
                      <!--CLIENTE NO PAGO-->
                    @if(auth::user()->Cliente===0)
                        <h3 class="product-name"><font face="Cera Pro Bold">{{ $pro->product_name }}</font></h3>
                        <h3 class="product-price"><font face="Cera Pro Bold">USD$</font></h3>
                        <div class="product-select">
                          <button class="add-to-wishlist round-icon-btn"> <i class="icon_heart_alt"></i></button>
                          <button class="add-to-cart round-icon-btn">  <i class="icon_bag_alt"></i></button>
                          
                       
                        </div>
                      </div>
                    </div>
					@endif
                     <!--VISTANTE-->
                     @else
                     <h3 class="product-name"><font face="Cera Pro Bold">{{ $pro->product_name }}</font></h3>
                        <h3 class="product-price"><font face="Cera Pro Bold">USD$</font></h3>
                        <div class="product-select">
                          <button class="add-to-wishlist round-icon-btn"> <i class="icon_heart_alt"></i></button>
                          <button class="add-to-compare round-icon-btn">  <i class="icon_cart_alt"></i></button>
                         
                          </div>
                      </div>
                    </div>
                     @endauth


           @endforeach
                  </div>
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
           


			


					<div align="center">{{ $productsAll->links() }}</div>
				</div><!--Características_artículos-->
			</div>
		</div>
	</div>
</section>

<style>
@media print {
  html, body {
     display: none;  /* hide whole page */
  }
}
</style>
@endsection

