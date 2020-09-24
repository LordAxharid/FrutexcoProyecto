@extends('layouts.adminLayout.admin_design')
@section('content')

<!--Contenedor principal-->
<div id="content">

    @if(Session::has('flash_message_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{!! session('flash_message_success') !!}</strong>
        </div>
    @endif

  <div class="container-fluid">
  <div class="topbar-bottom-colors">
      <i style="background-color: #2c3e50;"></i>
      <i style="background-color: #9857b2;"></i>
      <i style="background-color: #2c81ba;"></i>
      <i style="background-color: #5dc12e;"></i>
      <i style="background-color: #feb506;"></i>
      <i style="background-color: #e17c21;"></i>
      <i style="background-color: #bc382a;"></i>
    </div>
    <hr>
    <h1>Cotizacion #{{ $orderDetails->id }}</h1>
    <hr>
    <div class="row-fluid">
      <div class="span6">
        <div class="widget-box">
          <div class="widget-title">
            <h5>Detalles de la cotizacion</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-striped table-bordered">
              <tbody>
                <tr>
                  <td class="taskDesc">Fecha de cotizacion</td>
                  <td class="taskStatus">{{ $orderDetails->created_at }}</td>
                </tr>
                <tr>
                  <td class="taskDesc">Estado de cotizacion</td>
                  <td class="taskStatus">{{ $orderDetails->order_status }}</td>
                </tr>
                <tr>
                  <td class="taskDesc">Total de cotizacion</td>
                  <td class="taskStatus">USD {{ $orderDetails->grand_total }} $</td>
                </tr>
                <tr>
                  <td class="taskDesc">Gastos de envío</td>
                  <td class="taskStatus">USD {{ $orderDetails->shipping_charges }} $</td>
                </tr>
               <!-- <tr>
                  <td class="taskDesc">Codigo De Copun</td>
                  <td class="taskStatus">{{ $orderDetails->coupon_code }}</td>
                </tr>-->
               <!-- <tr>
                  <td class="taskDesc">Cantidad de cupón</td>
                  <td class="taskStatus">USD {{ $orderDetails->coupon_amount }} $</td>
                </tr>-->
                <tr>
                  <td class="taskDesc">Método de pago</td>
                  <td class="taskStatus">{{ $orderDetails->payment_method }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="accordion" id="collapse-group">
          <div class="accordion-group widget-box">
            <div class="accordion-heading">
              <div class="widget-title">
                <h5>Dirección del comprador</h5>
              </div>
            </div>
            <div class="collapse in accordion-body" id="collapseGOne">
              <div class="widget-content">
                {{ $userDetails->name }} <br>
                {{ $userDetails->address }} <br>
                {{ $userDetails->city }} <br>
                {{ $userDetails->state }} <br>
                {{ $userDetails->country }} <br>
                {{ $userDetails->pincode }} <br>
                {{ $userDetails->mobile }} <br>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="span6">
        <div class="widget-box">
          <div class="widget-title">
            <h5>Detalles del cliente</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-striped table-bordered">
              <tbody>
                <tr>
                  <td class="taskDesc">Nombre del cliente</td>
                  <td class="taskStatus">{{ $orderDetails->name }}</td>
                </tr>
                <tr>
                  <td class="taskDesc">Correo electrónico del cliente</td>
                  <td class="taskStatus">{{ $orderDetails->user_email }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="accordion" id="collapse-group">
          <div class="accordion-group widget-box">
            <div class="accordion-heading">
              <div class="widget-title">
                <h5>Actualizar estado de la cotizacion</h5>
              </div>
            </div>
            <div class="collapse in accordion-body" id="collapseGOne">
              <div class="widget-content">
                <form action="{{ url('admin/update-order-status') }}" method="post">{{ csrf_field() }}
                  <input type="hidden" name="order_id" value="{{ $orderDetails->id }}">
                  <table width="100%">
                    <tr>
                      <td>
                        <select name="order_status" id="order_status" class="control-label" required="">
                          <option value="Nuevo" @if($orderDetails->order_status == "Nuevo") selected @endif>Nuevo</option>
                          <option value="Pendiente" @if($orderDetails->order_status == "Pendiente") selected @endif>Pendiente</option>
                          <option value="Cancelado" @if($orderDetails->order_status == "Cancelado") selected @endif>Cancelado</option>
                          <option value="En Proceso" @if($orderDetails->order_status == "En Proceso") selected @endif>En Proceso</option>
                          <option value="Enviado" @if($orderDetails->order_status == "Enviado") selected @endif>Enviado</option>
                          <option value="Entregado" @if($orderDetails->order_status == "Entregado") selected @endif>Entregado</option>
                          <option value="Pago" @if($orderDetails->order_status == "Pago") selected @endif>Pago</option>
                        </select>
                      </td>
                      <td>
                        <input type="submit" value="Actualizar Estado">
                      </td>
                    </tr>
                  </table>
                </form>
              </div>
            </div>
          </div>
        </div>
       	<div class="accordion" id="collapse-group">
          <div class="accordion-group widget-box">
            <div class="accordion-heading">
              <div class="widget-title">
                <h5>Direccion de envio</h5>
              </div>
            </div>
            <div class="collapse in accordion-body" id="collapseGOne">
              <div class="widget-content">
                {{ $orderDetails->name }} <br>
                {{ $orderDetails->address }} <br>
                {{ $orderDetails->city }} <br>
                {{ $orderDetails->state }} <br>
                {{ $orderDetails->country }} <br>
                {{ $orderDetails->pincode }} <br>
                {{ $orderDetails->mobile }} <br></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row-fluid">
      <table id="example" class="table table-striped table-bordered" style="width:100%">
          <thead>
              <tr>
                  <th>Código de producto</th>
                  <th>Nombre del producto</th>
                  <th>Metodo De Envio</th>
                  <th>Color del producto</th>
                  <th>Precio del producto</th>
                  <th>Cantidad de producto</th>
              </tr>
          </thead>
          <tbody>
            @foreach($orderDetails->orders as $pro)
              <tr>
                  <td>{{ $pro->product_code }}</td>
                  <td>{{ $pro->product_name }}</td>
                  <td>{{ $pro->product_size }}</td>
                  <td>{{ $pro->product_color }}</td>
                  <td>{{ $pro->product_price }}</td>
                  <td>{{ $pro->product_qty }}</td>
              </tr>
              @endforeach
          </tbody>
      </table>
    </div>
  </div>
</div>
<!--Final Contenedor principal-->

@endsection
