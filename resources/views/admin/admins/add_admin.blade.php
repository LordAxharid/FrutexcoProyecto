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
    <h3>Administrador / sub-administrador</h3>
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Añadir administrador / sub-administrador</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('admin/add-admin') }}" name="add_admin" id="add_admin" novalidate="novalidate">{{ csrf_field() }}
              <div class="control-group">
                <label class="control-label">Tipo de administrador</label>
                <div class="controls">
                  <select name="type" id="type" style="width: 220px;">
                    <option value="Admin">Administrador</option>
                    <option value="Sub Admin">Sub administrador</option>
                  </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Nombre admin</label>
                <div class="controls">
                  <input type="text" name="username" id="username" required="">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Contraseña</label>
                <div class="controls">
                  <input type="password" name="password" id="password" required="">
                </div>
              </div>
              <div class="control-group" id="access">
                <label class="control-label">Acceso</label>
                <div class="controls">
                  <input type="checkbox" name="categories_view_access" id="categories_view_access" value="1" style="margin-top: -3px;">&nbsp;View Categories Only&nbsp;&nbsp;&nbsp;
                  <input type="checkbox" name="categories_edit_access" id="categories_edit_access" value="1" style="margin-top: -3px;">&nbsp;View and Edit Categories&nbsp;&nbsp;&nbsp;
                  <input type="checkbox" name="categories_full_access" id="categories_full_access" value="1" style="margin-top: -3px;">&nbsp;View, Edit and Delete Categories&nbsp;&nbsp;&nbsp;<br>
                  <input type="checkbox" name="products_access" id="products_access" value="1" style="margin-top: -3px;">&nbsp;Products&nbsp;&nbsp;&nbsp;
                  <input type="checkbox" name="orders_access" id="orders_access" value="1" style="margin-top: -3px;">&nbsp;Orders&nbsp;&nbsp;&nbsp;
                  <input type="checkbox" name="users_access" id="users_access" value="1" style="margin-top: -3px;">&nbsp;Users
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Habilitado</label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" value="1">
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Añadir Administrador" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
