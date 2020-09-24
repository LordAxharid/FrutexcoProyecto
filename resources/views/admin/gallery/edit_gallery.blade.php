@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Inicio</a> <a href="#">Galería</a> <a href="#" class="current">Editar galería</a> </div>
    <h1>Editar galería</h1>
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
            <h5>Editar galería</h5>
          </div>
          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('admin/edit-gallery/'.$galleryDetails->id) }}" name="edit_gallery" id="edit_gallery" novalidate="novalidate">{{ csrf_field() }}
              <div class="control-group">
                <label class="control-label"> Imagen</label>
                <div class="controls">
                  <div class="uploader" id="uniform-undefined"><input name="image" id="image" type="file" size="19" style="opacity: 0;"><span class="filename">No seleciono Imagen</span><span class="action">Escoger Archivo</span></div>
                  @if(!empty($galleryDetails->image))
                    <input type="hidden" name="current_image" value="{{ $galleryDetails->image }}">
                  @endif
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Nombre imagen</label>
                <div class="controls">
                  <input type="text" name="ImageName" id="title" value="{{ $galleryDetails->ImageName }}">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Habilitado</label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" value="1" @if($galleryDetails->status=="1") checked @endif>
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Editar imagen" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
