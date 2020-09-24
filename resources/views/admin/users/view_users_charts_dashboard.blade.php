<?php

$current_month = date('M');
$last_month = date('M',strtotime("-1 month"));
$last_to_last_month = date('M',strtotime("-2 month"));

$dataPoints = array(
  array("y" => $last_to_last_month_users, "label" => $last_to_last_month),
  array("y" => $last_month_users, "label" => $last_month),
  array("y" => $current_month_users, "label" => $current_month)
);

?>

@extends('layouts.adminLayout.admin_design')
@section('content')

<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
  title: {
    text: "Reporte De Usuarios"
  },
  axisY: {
    title: "Numero De Usuarios"
  },
  data: [{
    type: "line",
    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();

}
</script>

<div id="content">
 
    
<div class="container-fluid">
    <div class="topbar-bottom-colors">
      <i style="background-color: #9857b2;"></i>
      <i style="background-color: #2c81ba;"></i>
      <i style="background-color: #5dc12e;"></i>
      <i style="background-color: #feb506;"></i>
      <i style="background-color: #e17c21;"></i>
      <i style="background-color: #bc382a;"></i>
      <i style="background-color: #2c3e50;"></i>
    </div>
    <hr>
    <h1>Panel Principal</h1>
    <hr>
    @if(Session::has('flash_message_error'))
      <div class="alert alert-error alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>{!! session('flash_message_error') !!}</strong>
      </div>
    @endif

<!--Action boxes-->
<div class="container-fluid">
    <div class="quick-actions_homepage">
      <ul class="quick-actions">

        <!-- <li class="bg_lg span3"> <a href="charts.html"> <i class="icon-signal"></i> Charts</a> </li> -->
        @if(Session::get('adminDetails')['categories_view_access']==1)
        <li class="bg_ly"> <a href="{{ url('admin/view-categories') }}"> <i class="icon-tasks"></i><span class="label label-success">2</span> Categorías </a> </li>
        @endif
        @if(Session::get('adminDetails')['products_access']==1)
        <li class="bg_lo"> <a href="{{ url('admin/view-products') }}"> <i class="icon-tags"></i><span class="label label-success">2</span> Productos  </a> </li>
        @endif
        @if(Session::get('adminDetails')['orders_access']==1)
        <li class="bg_lb"> <a href="{{ url('admin/view-orders') }}"> <i class="icon-money"></i><span class="label label-success">2</span> Cotizaciones </a> </li>
        @endif
        @if(Session::get('adminDetails')['users_access']==1)
        <li class="bg_lo"> <a href="{{ url('/admin/view-banners') }}"> <i class="icon-bookmark"></i><span class="label label-success">2</span> Banners </a> </li>
        @endif
        @if(Session::get('adminDetails')['users_access']==1)
        <li class="bg_ly"> <a href="{{ url('/admin/view-gallery') }}"> <i class="icon-picture"></i><span class="label label-success">2</span> Galería </a> </li>
        @endif
        @if(Session::get('adminDetails')['users_access']==1)
        <li class="bg_lb"> <a href="{{ url('admin/view-users') }}"> <i class="icon-user"></i><span class="label label-success">4</span> Usuarios </a> </li>
        @endif
        @if(Session::get('adminDetails')['users_access']==1)
        <li class="bg_lo"> <a href="{{ url('/admin/view-admins') }}"> <i class="icon-group"></i><span class="label label-success">2</span> Admins/SubAdmins </a> </li>
        @endif
        @if(Session::get('adminDetails')['users_access']==1)
        <li class="bg_ly"> <a href="{{ url('/admin/view-cms-pages') }}"> <i class="icon-folder-open"></i><span class="label label-success">2</span> Pagina secundarias </a> </li>
        @endif
        @if(Session::get('adminDetails')['users_access']==1)
        <li class="bg_lb"> <a href="{{ url('/admin/get-enquiries') }}"> <i class="icon-envelope"></i><span class="label label-success">1</span> Inquietudes </a> </li>
        @endif
        @if(Session::get('adminDetails')['users_access']==1)
        <li class="bg_lb"> <a href="{{ url('admin/view-news') }}"> <i class="icon-print"></i><span class="label label-success">2</span> Noticias </a> </li>
        @endif
        @if(Session::get('adminDetails')['users_access']==1)
        <li class="bg_lo"> <a href="{{ url('admin/view-faq') }}"> <i class="icon-comments"></i><span class="label label-success">2</span> Preguntas Frecuentes </a> </li>
        @endif
        <!-- <li class="bg_lo"> <a href="tables.html"> <i class="icon-th"></i> Tables</a> </li>
        <li class="bg_ls"> <a href="grid.html"> <i class="icon-fullscreen"></i> Full width</a> </li>
        <li class="bg_lo span3"> <a href="form-common.html"> <i class="icon-th-list"></i> Forms</a> </li>
        <li class="bg_ls"> <a href="buttons.html"> <i class="icon-tint"></i> Buttons</a> </li>
        <li class="bg_lb"> <a href="interface.html"> <i class="icon-pencil"></i>Elements</a> </li>
        <li class="bg_lg"> <a href="calendar.html"> <i class="icon-calendar"></i> Calendar</a> </li>
        <li class="bg_lr"> <a href="error404.html"> <i class="icon-info-sign"></i> Error</a> </li> -->

      </ul>
    </div>
<!--End-Action boxes-->


    @if(Session::has('flash_message_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{!! session('flash_message_success') !!}</strong>
        </div>
    @endif
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Reporte de usuarios registrados</h5>
          </div>
          <div class="widget-content nopadding">
            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
@endsection
