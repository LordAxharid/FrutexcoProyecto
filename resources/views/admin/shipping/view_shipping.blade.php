@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Inicio</a> <a href="#">Envío</a> <a href="#" class="current">Ver envío</a> </div>
    <h1>Gastos de envío</h1>
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
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Gastos de envío</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>País</th>
                  <th>0g a 500g</th>
                  <th>501g a 1000g</th>
                  <th>1001g a 2000g</th>
                  <th>2001g a 5000g</th>
                  <th>Actualizado en</th>
                  <th>Acceso</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($shipping_charges as $shipping)
                <tr class="gradeX">
                  <td class="center">{{ $shipping->id }}</td>
                  <td class="center">{{ $shipping->country }}</td>
                  <td class="center">{{ $shipping->shipping_charges0_500g }}</td>
                  <td class="center">{{ $shipping->shipping_charges501_1000g }}</td>
                  <td class="center">{{ $shipping->shipping_charges1001_2000g }}</td>
                  <td class="center">{{ $shipping->shipping_charges2001_5000g }}</td>
                  <td class="center">{{ $shipping->updated_at }}</td>
                  <td class="center">
                    <a href="{{ url('admin/edit-shipping/'.$shipping->id) }}" class="btn btn-primary btn-mini">Editar</a>
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
