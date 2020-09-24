@extends('layouts.adminLayout.admin_design')
@section('content')

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
    <h3>Cotizacion</h3>
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Cotizacion</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table table-responsive">
              <thead>
                <tr>
                  <th>Cotizacion id</th>
                  <th>Fecha de cotizacion</th>
                  <th>Nombre del cliente</th>
                  <th>Correo electrónico del cliente</th>
                  <th>Productos pedidos</th>
                  <th>Total de la cotizacion</th>
                  <th>Estado de la cotizacion</th>
                  <th>Método de pago</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
          	@foreach($orders as $order)
                <tr class="gradeX">
                  <td class="center">{{ $order->id }}</td>
                  <td class="center">{{ $order->created_at }}</td>
                  <td class="center">{{ $order->name }}</td>
                  <td class="center">{{ $order->user_email }}</td>
                  <td class="center">
                    @foreach($order->orders as $pro)
                    {{ $pro->product_code }}
                    ({{ $pro->product_qty }})
                    <br>
                    @endforeach
                  </td>
                  <td class="center">USD {{ $order->grand_total }}$</td>
                  <td class="center">{{ $order->order_status }}</td>
                  <td class="center">{{ $order->payment_method }}</td>
                  <td class="center">
                    <a target="_blank" href="{{ url('admin/view-order/'.$order->id)}}" class="btn btn-success btn-mini">Ver detalles de la cotizacion</a><br><br>
                    @if($order->order_status == "Enviado" || $order->order_status == "Entregado" || $order->order_status == "Pago")
                      <a target="_blank" href="{{ url('admin/view-order-invoice/'.$order->id)}}" class="btn btn-warning btn-mini">Ver codigo de barras cotizacion</a><br><br>
                      <a target="_blank" href="{{ url('admin/view-pdf-invoice/'.$order->id)}}" class="btn btn-primary btn-mini">Ver cotizacion en PDF</a>
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
