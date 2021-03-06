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
  
   
    @if(Session::has('flash_message_error'))
      <div class="alert alert-error alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>{!! session('flash_message_error') !!}</strong>
      </div>
    @endif
    @if(Session::has('flash_message_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{!! session('flash_message_success') !!}</strong>
        </div>
    @endif
  
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
    <h3>Usuario</h3>
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
