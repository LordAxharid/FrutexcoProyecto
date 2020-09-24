<?php
use App\Http\Controllers\Controller;
use App\Product;
use App\Gallery;
$mainCategories =  Controller::mainCategories();
$cartCount = Product::cartCount();
?>






<!--AQUI TOCA CAMBIAR EL DISEÑO-->



	<header> 
        <div class="header-block d-flex align-items-center">
          <div class="container">
            <div class="row">
              <div class="col-12 col-md-6">
                <div class="header-left d-flex flex-column flex-md-row align-items-center">
                  <p class="d-flex align-items-center"><i class="fas fa-envelope"></i>Director@frutexco.com</p>
                  <p class="d-flex align-items-center"><i class="fas fa-phone"></i>+57 3123776063</p>
                  <p class="d-flex align-items-center"><i class="fas fa-at"></i><a href="{{ url('page/post') }}" class="text-dark">Contactanos</a></p>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="header-right d-flex flex-column flex-md-row justify-content-md-end justify-content-center align-items-center">
                  <div class="social-link d-flex"><a href=""><i class="fab fa-facebook-f"></i></a><a href=""><i class="fab fa-twitter"></i></a> </i></a></div>
                  <div class="navigation-filter"> 
         
                <div class="department-menu_block">
                  <div Style="height: 40px;" class="department-menu d-flex justify-content-between align-items-center"><i class="fas fa-globe-americas"></i>Idioma<span><i class="arrow_carrot-down"></i></span></div>
                  <div class="department-dropdown-menu">
                    <ul>
                  
                    <style type="text/css">

<style type="text/css">

#goog-gt-tt {display:none !important;}
.goog-te-banner-frame {display:none !important;}
.goog-te-menu-value:hover {text-decoration:none !important;}


body {top:0 !important;}

</style>
<div id="google_translate_element"></div>
<script type="text/javascript">
function googleTranslateElementInit() {new google.translate.TranslateElement({pageLanguage: 'es', layout: google.translate.TranslateElement.InlineLayout.SIMPLE,autoDisplay: false, includedLanguages: ''}, 'google_translate_element');}
</script><script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>


                    </ul>
                  </div>
                </div>
              </div>
              
<div class="btn btn-white"></div>

                  @if(empty(Auth::check()))
                  <div class="navigation-filter"> 
         
         <div class="department-menu_block">
           <div Style="height: 40px;" class="department-menu d-flex justify-content-between align-items-center"><i class="fas fa-user"></i>Ingresar<span><i class="arrow_carrot-down"></i></span></div>
           <div class="department-dropdown-menu">
             <ul>
           
                                 <li><i class="icon-"> <a href="{{ url('/login-register') }}"><font face="Cera Pro Bold">Ingresar</font></a></i></li>
                               
           
             </ul>
           </div>
         </div>
       </div>
                  
                  @else
                  <div class="navigation-filter"> 
         
                <div class="department-menu_block">
                  <div Style="height: 40px;" class="department-menu d-flex justify-content-between align-items-center"><i class="fas fa-user"></i>  Mi Cuenta<span><i class="arrow_carrot-down"></i></span></div>
                  <div class="department-dropdown-menu">
                    <ul>
                  
                                        <li><i class="icon-"> <a href="{{ url('/account') }}"><font face="Cera Pro Bold">Cuenta</font></a></i></li>
                                        <li><i class="icon-"> <a href="{{ url('/orders') }}"><font face="Cera Pro Bold">Cotizaciones</font></a></i></li>
                                        <li><i class="icon-"> <a href="{{ url('/user-logout') }}"><font face="Cera Pro Bold">Cerrar Sesion</font></a></i></li>
									
                    </ul>
                  </div>
                </div>
              </div>

                  @endif
                </div>
              </div>
            </div>
          </div>
		</div>

    <nav class="navigation d-flex align-items-center">
          <div class="container">
            <div class="row">
            <div class="col-2"><a class="logo" href="{{ url('./')}}"><img src="{{ asset('images/frontend_images/home/FRUTEXCO.png') }}" alt=""></a></div>
              <div class="col-9">
                <div class="navgition-menu d-flex align-items-center justify-content-center">
                  <ul class="mb-0">
                  
                    <li class="toggleable"><a class="menu-item" href="{{ url('./')}}">Inicio</a></li>

                    <li class="toggleable"><a class="menu-item" href="{{ url('About') }}">Quiénes somos</a></li>
                     
                    <li class="toggleable"><a class="menu-item" href="{{ url('News') }}">Noticias</a></li>
                     
                    <li class="toggleable"><a class="menu-item" href="{{ url('Gallery') }}">Galería</a></li>

                    <li class="toggleable"><a class="menu-item" href="{{ url('Faqs') }}">Preguntas frecuentes</a></li>

                  </ul>
                </div>
              </div>
              <div class="row">
              <div class="col-12">
                <div class="product-function d-flex align-items-center justify-content-end">
                <div id="wishlist"><a class="function-icon icon_heart_alt" href="{{ url('/wish-list') }}"></a></div>
                <div  id="wishlist"><font face="Cera Pro Bold"> <a class="function-icon icon_cart_alt" href="{{ url('/cart') }}"></a>({{ $cartCount }})</div></font>
                </div>
              </div>
              </div>
            </div>
          </div>
        </nav>

        <div class="navigation-filter"> 
          <div class="container">
            <div class="row">
              <div class="col-12 col-md-4 col-lg-4 col-xl-3 order-2 order-md-1">
                <div class="department-menu_block">
                  <div class="department-menu d-flex justify-content-between align-items-center"><i class="fas fa-bars"></i>Nuestras Categorías<span><i class="arrow_carrot-down"></i></span></div>
                  <div class="department-dropdown-menu">
                    <ul>
                    @foreach($mainCategories as $cat)
                                        <li><i class="icon-5"> <a href="{{ asset('products/'.$cat->url) }}"><font face="Cera Pro Bold">	{{ $cat->name }}</font></a></i></li>
										@endforeach
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-8 col-lg-8 col-xl-9 order-1 order-md-2">
                <div class="website-search">
                  <div class="row no-gutters">
                    <div class="col-0 col-md-0 col-lg-4 col-xl-3">
                      <div class="filter-search">
                        <div class="categories-select d-flex align-items-center justify-content-around"><span></span><i class=""></i></div>
                       
                      </div>
                    </div>
               
                    <div class="col-8 col-md-8 col-lg-5 col-xl-7">
                      <div class="search-input">
                      <form action="{{  url('/search-products') }}" method="post">{{ csrf_field() }}
                        <input class="no-round-input no-border" name="product" type="text" placeholder="Que Buscas?" required>
                      </div>
                    </div>
                    <div class="col-4 col-md-4 col-lg-3 col-xl-2">
                      <button type="submit" class="no-round-btn">Buscar</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      

        <div id="mobile-menu">
          <div class="container">
            <div class="row">
              <div class="col-3">
                <div class="mobile-menu_block d-flex align-items-center"><a class="mobile-menu--control" href="#"><i class="fas fa-bars"></i></a>
                <br>
                  <div id="ogami-mobile-menu">
                    <button class="no-round-btn" id="mobile-menu--closebtn">Cerrar menu</button>
                    <div class="mobile-menu_items">
                      <ul class="mb-0 d-flex flex-column">
                        <li class="toggleable"> <a class="menu-item active" href="{{ url('/') }}">Inicio</a><span class="sub-menu--expander"></span>
                         
                        <li class="toggleable"><a class="menu-item" href="{{ url('Gallery') }}">Galería</a><span class="sub-menu--expander"></span></li>
                         
                        <li class="toggleable"> <a class="menu-item" href="blog_list_sidebar.html">Quienes somos</a><span class="sub-menu--expander"></span></li>
                               
                        <li class="toggleable"><a class="menu-item" href="#">Noticias</a><span class="sub-menu--expander"></span></li>
                         
                        <li class="toggleable"><a class="menu-item" href="#">Preguntas frecuentes</a><span class="sub-menu--expander"></span></li>

                        <li class="toggleable"><a class="menu-item" href="#">Contactanos</a><span class="sub-menu--expander"></span></li>

                      </ul>
                    </div>

                    <div class="mobile-login">
                      <h2>Mi cuenta</h2><a href="{{ url('/account') }}">Cuenta</a><a href="{{ url('/orders') }}">Cotizaciones</a><a href="{{ url('/user-logout') }}">Cerrar Sesion</a>
                    </div>
                    
                  </div>
                  <div class="ogamin-mobile-menu_bg"></div>
                </div>
              </div>
              <div class="col-6">
                <div class="mobile-menu_logo text-center d-flex justify-content-center align-items-center"><a href=""><img src="assets/images/logo.png" alt=""></a></div>
              </div>
              <br>
              <div class="col-12">
                <div class="mobile-product_function d-flex align-items-center justify-content-end"><li><a href="{{ url('/wish-list') }}"><i class="fa fa-star"></i> Lista de deseo</a></li>
                
                <li><a href="{{ url('/cart') }}"><i class="fa fa-shopping-cart"></i> Carrito ({{ $cartCount }})</a></li>
                @if(empty(Auth::check()))
									<li><a href="{{ url('/login-register') }}"><i class="fa fa-lock"></i> Ingresar</a></li>
								@else
               
                <div class="navigation-filter"> 
          <div class="container">
            <div class="row">
              <div class="col-12 col-md-4 col-lg-4 col-xl-3 order-2 order-md-1">
                <div class="department-menu_block">
                  <div class="department-menu d-flex justify-content-between align-items-center"><i class="arrow_carrot-down"></i>Tu cuenta<span><i class="arrow_carrot-down"></i></span></div>
                  <div class="department-dropdown-menu">
                    <ul>
                    <li style="font-size: 10px;"><a href="{{ url('/account') }}"><i class=""></i><h3> Datos</h3></a></li>
                    <li style="font-size: 10px;"><a href="{{ url('/orders') }}"><i class=""></i> <h3>Cotizaciones</h3></a></li>
								    <li style="font-size: 10px;"><a href="{{ url('/user-logout') }}"><i class=""></i><h3>Cerrar sesión</h3></a></li>
                    </ul>
                  </div>
                </div>
              </div>
           
            </div>
          </div>
        </div>
                       
								@endif
              </div>
            </div>
          </div>
        </div>
        <br>
       
      </header>
      <br>
      <!-- End header-->

      


      <!--
#goog-gt-tt {display:none !important;}
.goog-te-banner-frame {display:none !important;}
.goog-te-menu-value:hover {text-decoration:none !important;}


body {top:0 !important;}
-->
