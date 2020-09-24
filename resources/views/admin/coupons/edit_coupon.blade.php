@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Inicio</a> <a href="#">Cupones</a> <a href="#" class="current">Añadir cupones</a> </div>
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
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Editar Cupones</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('admin/edit-coupon/'.$couponDetails->id) }}" name="add_coupon" id="add_coupon">{{ csrf_field() }}
              <div class="control-group">
                <label class="control-label">Tipo de cantidad</label>
                <div class="controls">
                  <select name="amount_type" id="amount_type" style="width:220px;">
                    <option @if($couponDetails->amount_type=="Percentage") selected @endif value="Percentage">Porcentage</option>
                    <option @if($couponDetails->amount_type=="Fixed") selected @endif value="Fixed">Fixed</option>
                  </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Código promocional</label>
                <div class="controls">
                  <input value="{{ $couponDetails->coupon_code }}" type="text" name="coupon_code" id="coupon_code" maxlength="15" minlength="5" required>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Cantidad</label>
                <div class="controls">
                  <input value="{{ $couponDetails->amount }}" type="number" name="amount" id="amount" required>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Fecha de caducidad</label>
                <div class="controls">
                  <input autocomplete="off" value="{{ $couponDetails->expiry_date }}" type="text" name="expiry_date" id="expiry_date" required>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Habilitar</label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" value="1" @if($couponDetails->status=="1") checked @endif>
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Add Coupon" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
