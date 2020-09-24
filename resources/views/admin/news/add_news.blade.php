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
    <h3>Noticia</h3>
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Añadir noticia</h5>
          </div>
          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('/admin/add-news') }}" name="add-news" id="add-news" novalidate="novalidate">{{ csrf_field() }}
              <div class="control-group">
                <label class="control-label">Imagen de noticia</label>
                <div class="controls">
                  <div class="uploader" id="uniform-undefined"><input name="image" id="image" type="file" size="19" style="opacity: 0;"><span class="filename">No seleciono Imagen</span><span class="action">Escoger Archivo</span></div>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Título noticia</label>
                <div class="controls">
                  <input type="text" name="title" id="title">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Descripción noticia</label>
                <div class="controls">
                  <textarea rows="4" cols="40" type="text" name="newDescription" id="newDescription">
                  </textarea>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Habilitado</label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" value="1">
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Añadir Noticia" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
