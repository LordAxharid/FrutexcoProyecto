@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Inicio</a> <a href="#">Páginas de CMS</a> <a href="#" class="current">Editar página CMS</a> </div>
    <h1>Páginas de CMS</h1>
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
            <h5>Editar página de CMS</h5>
          </div>
          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('admin/edit-cms-page/'.$cmsPage->id) }}" name="add_cms_page" id="add_cms_page" novalidate="novalidate">{{ csrf_field() }}
              <div class="control-group">
                <label class="control-label">Titulo</label>
                <div class="controls">
                  <input type="text" name="title" id="title" value="{{ $cmsPage->title }}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">URL de página de CMS</label>
                <div class="controls">
                  <input type="text" name="url" id="url" value="{{ $cmsPage->url }}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Descripción</label>
                <div class="controls">
                  <textarea name="description">{{ $cmsPage->description }}</textarea>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Meta título</label>
                <div class="controls">
                  <input type="text" name="meta_title" id="meta_title" value="{{ $cmsPage->meta_title }}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Meta descripción</label>
                <div class="controls">
                  <input type="text" name="meta_description" id="meta_description" value="{{ $cmsPage->meta_description }}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Meta palabras clave</label>
                <div class="controls">
                  <input type="text" name="meta_keywords" id="meta_keywords" value="{{ $cmsPage->meta_keywords }}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Habilitar</label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" @if($cmsPage->status=="1") checked @endif value="1">
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Editar página de CMS" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
