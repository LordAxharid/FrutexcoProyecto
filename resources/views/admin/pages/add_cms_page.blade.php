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
    <h3>Páginas de CMS</h3>
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Agregar página CMS</h5>
          </div>
          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('admin/add-cms-page') }}" name="add_cms_page" id="add_cms_page">{{ csrf_field() }}
              <div class="control-group">
                <label class="control-label">Título</label>
                <div class="controls">
                  <input type="text" name="title" id="title" required="">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">URL de página de CMS</label>
                <div class="controls">
                  <input type="text" name="url" id="url" required="">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Descripción</label>
                <div class="controls">
                  <textarea name="description" required=""></textarea>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Meta título</label>
                <div class="controls">
                  <input type="text" name="meta_title" id="meta_title">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Meta descripción</label>
                <div class="controls">
                  <input type="text" name="meta_description" id="meta_description">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Meta palabras clave</label>
                <div class="controls">
                  <input type="text" name="meta_keywords" id="meta_keywords">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Habilitar</label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" value="1">
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Agregar página CMS" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
