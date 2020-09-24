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
    <h3>Página De Permiso Cliente</h3>
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Editar página cliente</h5>
          </div>
          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('/admin/edit-client-page/'.$users->id) }}" name="Cliente" id="Cliente" novalidate="novalidate">{{ csrf_field() }}

                <div class="control-group">
                <label class="control-label">Cliente</label>
                <div class="controls">
                <input type="text" name="Cliente" id="Cliente" value="{{ $users->Cliente }}">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Id</label>
                <div class="controls">
                <input type="text" name="id" id="id" value="{{ $users->id }}" readonly>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Nombre</label>
                <div class="controls">
                <input type="text" name="name" id="name" value="{{ $users->name }}" readonly>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Email</label>
                <div class="controls">
                <input type="text" name="email" id="email" value="{{ $users->email }}" readonly>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Estado</label>
                <div class="controls">
                <input type="text" name="status" id="status" value="{{ $users->status }}" readonly>
                </div>
              </div>
                  <div class="form-actions">
                <input type="submit" value="Editar permiso" class="btn btn-success">
              </div>
                </div>
              </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
