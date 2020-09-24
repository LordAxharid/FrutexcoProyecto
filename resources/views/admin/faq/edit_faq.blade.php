@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> inicio</a> <a href="#">FAQ</a> <a href="#" class="current">Edit FAQ</a> </div>
    <h1>Editar FAQ</h1>
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
            <h5>Editar faq</h5>
          </div>
          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('admin/edit-faq/'.$FaqDetails->id) }}" name="edit-faq" id="edit-faq" novalidate="novalidate">{{ csrf_field() }}
              <div class="control-group">

                <div class="controls">

              </div>

              <div class="control-group">
                <label class="control-label">Pregunta</label>
                <div class="controls">
                  <input type="text" name="ask" id="ask" value="{{ $FaqDetails->ask }}">
                </div>
              </div>


              <div class="control-group">
                <label class="control-label">Respuesta</label>
                <div class="controls">
                  <textarea name="answer" class="textarea_editor span12">{{ $FaqDetails->answer }}</textarea>
                </div>

              <div class="control-group">
                <label class="control-label">Habilitado</label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" value="1" @if($FaqDetails->status=="1") checked @endif>
                </div>
              </div>
              <div class="form-actions">

                <input type="submit" value="Editar faq" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
