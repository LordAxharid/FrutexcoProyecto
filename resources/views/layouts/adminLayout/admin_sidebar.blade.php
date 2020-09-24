
<?php $url = url()->current(); ?>

<!--Menu de barra lateral-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Menu</a>
  <ul>
  <div class="topbar-bottom-colors">
      <i style="background-color: #2c3e50;"></i>
      <i style="background-color: #2c3e50;"></i>
      <i style="background-color: #2c3e50;"></i>
      <i style="background-color: #2c3e50;"></i>
      <i style="background-color: #2c3e50;"></i>
      <i style="background-color: #2c3e50;"></i>
      <i style="background-color: #2c3e50;"></i>
    </div>
<br>

    <li Style="line-height: 40px;" <?php if (preg_match("/dashboard/i", $url)){ ?> class="active" <?php } ?>><a href="{{ url('/admin/dashboard') }}"><i class="mdi mdi-home-modern"></i></i><span>Panel principal</span></a> </li>

    
    @if(Session::get('adminDetails')['categories_full_access']==1)
    <li  Style="line-height: 40px;" class="submenu"  > <a href="#"><i class="mdi mdi-folder-multiple"></i> <span>Categorías</span> <span Style="background-color:#fff; color: #000;" class="label label-important">🡣</span></a>
    <ul <?php if (preg_match("/categor/i", $url)){ ?> style="display: block;" <?php } ?>>
    <hr style="height:2px;border:none;color:#333;background-color: #4c4ad5;" />  

        <li <?php if (preg_match("/add-category/i", $url)){ ?> class="active" <?php } ?>><a class="mdi mdi-file-outline" href="{{ url('/admin/add-category')}}"> Agregar categorías</a></li>
        <li <?php if (preg_match("/view-categories/i", $url)){ ?> class="active" <?php } ?>><a class="mdi mdi-file-multiple" href="{{ url('/admin/view-categories')}}"> Ver categorías</a></li>
        
        <hr style="height:2px;border:none;color:#333;background-color: #4c4ad5;" />
      </ul>
    </li>
    @endif

   
    @if(Session::get('adminDetails')['products_access']==1)
     <li  Style="line-height: 40px;" class="submenu"> <a href="#"><i class="mdi mdi-package-variant"></i> <span>Productos</span> <span Style="background-color:#fff; color: #000;" class="label label-important">🡣</span></a>
      <ul <?php if (preg_match("/product/i", $url)){ ?> style="display: block;" <?php } ?>>
      <hr style="height:2px;border:none;color:#333;background-color: #4c4ad5;" />  
        <li <?php if (preg_match("/add-product/i", $url)){ ?> class="active" <?php } ?>><a class="mdi mdi-file-outline" href="{{ url('/admin/add-product')}}"> Agregar producto</a></li>
        <li <?php if (preg_match("/view-products/i", $url)){ ?> class="active" <?php } ?>><a class="mdi mdi-file-multiple" href="{{ url('/admin/view-products')}}"> Ver producto</a></li>
        <hr style="height:2px;border:none;color:#333;background-color: #4c4ad5;" />  
      </ul>
    </li>
    @endif

    <!--@if(Session::get('adminDetails')['type']=="Admin")
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Cupones</span> <span class="label label-important">2</span></a>
      <ul <?php if (preg_match("/coupon/i", $url)){ ?> style="display: block;" <?php } ?>>
        <li <?php if (preg_match("/add-coupon/i", $url)){ ?> class="active" <?php } ?>><a href="{{ url('/admin/add-coupon')}}">Agregar Cupon</a></li>
        <li <?php if (preg_match("/view-coupons/i", $url)){ ?> class="active" <?php } ?>><a href="{{ url('/admin/view-coupons')}}">Ver Cupon</a></li>
      </ul>
    </li>
    @endif -->


    @if(Session::get('adminDetails')['orders_access']==1)
    <?php
       $base_order_url = trim(basename($url));
    ?>
    <li  Style="line-height: 40px;" class="submenu"> <a href="#"><i class="mdi mdi-cash-multiple"></i> <span>Cotizaciones</span> <span Style="background-color:#fff; color: #000;" class="label label-important">🡣</span></a>
      <ul <?php if (preg_match("/orders/i", $url)){ ?> style="display: block;" <?php } ?>>
      <hr style="height:2px;border:none;color:#333;background-color: #4c4ad5;" />  
      <li <?php if ($base_order_url=="view-orders"){ ?> class="active" <?php } ?>><a class="mdi mdi-file-outline" href="{{ url('/admin/view-orders')}}"> Ver cotizaciones</a></li>
        <li <?php if ($base_order_url=="view-orders-charts"){ ?> class="active" <?php } ?>><a class="mdi mdi-file-multiple" href="{{ url('/admin/view-orders-charts')}}"> Ver gráfica de cotizaciones</a></li>
        <hr style="height:2px;border:none;color:#333;background-color: #4c4ad5;" />  
      </ul>
    </li>
    @endif


    @if(Session::get('adminDetails')['type']=="Admin")
    <li  Style="line-height: 40px;" class="submenu"> <a href="#"><i class="mdi mdi-television-guide"></i> <span>Banners</span> <span Style="background-color:#fff; color: #000;" class="label label-important">🡣</span></a>
      <ul <?php if (preg_match("/banner/i", $url)){ ?> style="display: block;" <?php } ?>>
      <hr style="height:2px;border:none;color:#333;background-color: #4c4ad5;" />  
      <li <?php if (preg_match("/add-banner/i", $url)){ ?> class="active" <?php } ?>><a class="mdi mdi-file-outline" href="{{ url('/admin/add-banner')}}"> Agregar banner</a></li>
        <li <?php if (preg_match("/view-banners/i", $url)){ ?> class="active" <?php } ?>><a class="mdi mdi-file-multiple" href="{{ url('/admin/view-banners')}} ">Ver banners</a></li>
        <hr style="height:2px;border:none;color:#333;background-color: #4c4ad5;" />  
      </ul>
    </li>
    @endif

    @if(Session::get('adminDetails')['type']=="Admin")
    <li  Style="line-height: 40px;" class="submenu"> <a href="#"><i class="icon-picture"></i> <span>Galería</span> <span Style="background-color:#fff; color: #000;" class="label label-important">🡣</span></a>
      <ul <?php if (preg_match("/gallery/i", $url)){ ?> style="display: block;" <?php } ?>>
      <hr style="height:2px;border:none;color:#333;background-color: #4c4ad5;" />  
        <li <?php if (preg_match("/add-gallery/i", $url)){ ?> class="active" <?php } ?>><a class="mdi mdi-file-outline" href="{{ url('/admin/add-gallery')}}"> Agregar imagen</a></li>
        <li <?php if (preg_match("/view-gallery/i", $url)){ ?> class="active" <?php } ?>><a class="mdi mdi-file-multiple" href="{{ url('/admin/view-gallery')}}"> Ver imagenes</a></li>
        <hr style="height:2px;border:none;color:#333;background-color: #4c4ad5;" />  
      </ul>
    </li>
    @endif


    @if(Session::get('adminDetails')['users_access']==1)
    <?php
       $base_user_url = trim(basename($url));
    ?>
    <li  Style="line-height: 40px;" class="submenu"> <a href="#"><i class="icon-user"></i> <span>Usuarios</span> <span Style="background-color:#fff; color: #000;" class="label label-important">🡣</span></a>
      <ul <?php if (preg_match("/users/i", $url)){ ?> style="display: block;" <?php } ?>>
      <hr style="height:2px;border:none;color:#333;background-color: #4c4ad5;" />  
        <li <?php if ($base_user_url=="view-users"){ ?> class="active" <?php } ?>><a class="mdi mdi-file-multiple" href="{{ url('/admin/view-users')}}">Ver Usuarios</a></li>
        <li <?php if ($base_user_url=="view-user-client"){ ?> class="active" <?php } ?>><a class="mdi mdi-file-outline" href="{{ url('/admin/view-user-client')}}"> Actualizar cliente</a></li>
        <li <?php if ($base_user_url=="view-users-charts"){ ?> class="active" <?php } ?>><a class="mdi mdi-file-multiple" href="{{ url('/admin/view-users-charts')}}"> Ver gráfico de usuarios</a></li>
        <li <?php if ($base_user_url=="view-users-countries-charts"){ ?> class="active" <?php } ?>><a class="mdi mdi-file-multiple" href="{{ url('/admin/view-users-countries-charts')}}"> Ver países de usuarios</a></li>
        <hr style="height:2px;border:none;color:#333;background-color: #4c4ad5;" />  
      </ul>
    </li>
    @endif



    @if(Session::get('adminDetails')['type']=="Admin")
    <li  Style="line-height: 40px;" class="submenu"> <a href="#"><i class="mdi mdi-worker"></i> <span>Admins/sub-admins</span> <span Style="background-color:#fff; color: #000;" class="label label-important">🡣</span></a>
      <ul <?php if (preg_match("/admins/i", $url)){ ?> style="display: block;" <?php } ?>>
      <hr style="height:2px;border:none;color:#333;background-color: #4c4ad5;" />  
        <li <?php if (preg_match("/add-admin/i", $url)){ ?> class="active" <?php } ?>><a class="mdi mdi-file-outline" href="{{ url('/admin/add-admin')}}"> Agregar admin/sub-admin</a></li>
        <li <?php if (preg_match("/view-admins/i", $url)){ ?> class="active" <?php } ?>><a class="mdi mdi-file-multiple" href="{{ url('/admin/view-admins')}}"> Ver admins/sub-admins</a></li>
        <hr style="height:2px;border:none;color:#333;background-color: #4c4ad5;" />  
      </ul>
    </li>
    @endif


    @if(Session::get('adminDetails')['type']=="Admin")
    <li  Style="line-height: 40px;" class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Páginas secundarias</span> <span Style="background-color:#fff; color: #000;" class="label label-important">🡣</span></a>
      <ul <?php if (preg_match("/cms-page/i", $url)){ ?> style="display: block;" <?php } ?>>
      <hr style="height:2px;border:none;color:#333;background-color: #4c4ad5;" />  
        <li <?php if (preg_match("/add-cms-page/i", $url)){ ?> class="active" <?php } ?>><a class="mdi mdi-file-outline" href="{{ url('/admin/add-cms-page')}}"> Agregar páginas </a></li>
        <li <?php if (preg_match("/view-cms-pages/i", $url)){ ?> class="active" <?php } ?>><a class="mdi mdi-file-multiple" href="{{ url('/admin/view-cms-pages')}}"> Ver páginas </a></li>
        <hr style="height:2px;border:none;color:#333;background-color: #4c4ad5;" />  
      </ul>
    </li>
    <li  Style="line-height: 40px;" class="submenu"> <a href="#"><i class="mdi mdi-plus-network"></i> <span>Inquietudes</span> <span Style="background-color:#fff; color: #000;" class="label label-important">🡣</span></a>
      <ul <?php if (preg_match("/enquiries/i", $url)){ ?> style="display: block;" <?php } ?>>
      <hr style="height:2px;border:none;color:#333;background-color: #4c4ad5;" />  
        <li <?php if (preg_match("/view-enquiries/i", $url)){ ?> class="active" <?php } ?>><a class="mdi mdi-file-outline" href="{{ url('/admin/get-enquiries')}}"> Ver inquietudes</a></li>
        <hr style="height:2px;border:none;color:#333;background-color: #4c4ad5;" />  
      </ul>
    </li>
    <!--<li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Moneda</span> <span class="label label-important">2</span></a>
      <ul <?php if (preg_match("/currencies/i", $url)){ ?> style="display: block;" <?php } ?>>
        <li <?php if (preg_match("/add-currency/i", $url)){ ?> class="active" <?php } ?>><a href="{{ url('/admin/add-currency')}}">Agregar Monedas</a></li>
        <li <?php if (preg_match("/view-currencies/i", $url)){ ?> class="active" <?php } ?>><a href="{{ url('/admin/view-currencies')}}">Ver Monedas</a></li>
      </ul>
    </li>-->
    <!--<li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Envios</span> <span class="label label-important">1</span></a>
      <ul <?php if (preg_match("/shipping/i", $url)){ ?> style="display: block;" <?php } ?>>
        <li <?php if (preg_match("/view-shipping/i", $url)){ ?> class="active" <?php } ?>><a href="{{ url('/admin/view-shipping')}}">Cantidad De Envios</a></li>
      </ul>
    </li>-->
   <!-- <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Suscripcion A Noticias</span> <span class="label label-important">1</span></a>
      <ul <?php if (preg_match("/newsletter-subscribers/i", $url)){ ?> style="display: block;" <?php } ?>>
        <li <?php if (preg_match("/newsletter-subscribers/i", $url)){ ?> class="active" <?php } ?>><a href="{{ url('/admin/view-newsletter-subscribers')}}">Suscripcion a noticias</a></li>
      </ul>
    </li>-->
    @endif

<!--NOTICIAS!!!-->
@if(Session::get('adminDetails')['type']=="Admin")
    <li  Style="line-height: 40px;" class="submenu"> <a href="#"><i class="mdi mdi-newspaper"></i> <span>Noticias</span> <span Style="background-color:#fff; color: #000;" class="label label-important">🡣</span></a>
      <ul <?php if (preg_match("/news/i", $url)){ ?> style="display: block;" <?php } ?>>
      <hr style="height:2px;border:none;color:#333;background-color: #4c4ad5;" />  
        <li <?php if (preg_match("/add-news/i", $url)){ ?> class="active" <?php } ?>><a class="mdi mdi-file-outline" href="{{ url('/admin/add-news')}}"> Agregar noticia</a></li>
        <li <?php if (preg_match("/view-news/i", $url)){ ?> class="active" <?php } ?>><a class="mdi mdi-file-multiple" href="{{ url('admin/view-news')}}"> Ver noticias</a></li>
        <hr style="height:2px;border:none;color:#333;background-color: #4c4ad5;" />  
      </ul>
    </li>
    @endif

    <!--FAQS!!!-->
@if(Session::get('adminDetails')['type']=="Admin")
    <li  Style="line-height: 40px;" class="submenu"> <a href="#"><i class="icon-info-sign"></i> <span>Preguntas frecuentes</span> <span Style="background-color:#fff; color: #000;" class="label label-important">🡣</span></a>
      <ul <?php if (preg_match("/faq/i", $url)){ ?> style="display: block;" <?php } ?>>
      <hr style="height:2px;border:none;color:#333;background-color: #4c4ad5;" />  
        <li <?php if (preg_match("/add-faq/i", $url)){ ?> class="active" <?php } ?>><a class="mdi mdi-file-outline" href="{{ url('/admin/add-faq')}}"> Agregar pregunta/respuesta</a></li>
        <li <?php if (preg_match("/view-faq/i", $url)){ ?> class="active" <?php } ?>><a class="mdi mdi-file-multiple" href="{{ url('admin/view-faq')}}"> Ver pregunta/respuesta</a></li>
        <hr style="height:2px;border:none;color:#333;background-color: #4c4ad5;" />  
      </ul>
    </li>
    @endif



  </ul>
</div>
<!--sidebar-menu-->
