@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Inicio</a> <a href="#">Cupones</a> <a href="#" class="current">Ver cupones</a> </div>
    <h1>Cupones</h1>
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
            <h5>Coupons</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Código de cupón</th>
                  <th>Cantidad</th>
                  <th>Tipo de cantidad</th>
                  <th>Fecha de expiración</th>
                  <th>Estado</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($coupons as $coupon)
                <tr class="gradeX">
                  <td class="center">{{ $coupon->id }}</td>
                  <td class="center">{{ $coupon->coupon_code }}</td>
                  <td class="center">{{ $coupon->amount }}</td>
                  <td class="center">{{ $coupon->amount_type }}</td>
                  <td class="center">{{ $coupon->expiry_date }}</td>
                  <td class="center">@if($coupon->status==1) Active @else Inactive @endif</td>
                  <td class="center">
                    <a href="{{ url('/admin/edit-coupon/'.$coupon->id) }}" class="btn btn-primary btn-mini">Editar</a>
                    <a id="delCoupon" rel="{{ $coupon->id }}" rel1="delete-coupon" href="javascript:" class="btn btn-danger btn-mini deleteRecord">Eliminar</a>
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
