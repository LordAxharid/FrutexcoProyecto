@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Inicio</a> <a href="#">Seguidores De Noticias</a> <a href="#" class="current">Ver Noticias</a> </div>
    <h1>Noticias</h1>
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
  <div style="margin-left:20px;">
    <a href="{{ url('/admin/export-newsletter-emails') }}" class="btn btn-primary btn-mini">Exportar</a>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Noticias</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Usuario ID</th>
                  <th>Correo Electronico</th>
                  <th>Estado</th>
                  <th>Creado en</th>
                  <th>Accciones</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($newsletters as $newsletter)
                <tr class="gradeX">
                  <td class="center">{{ $newsletter->id }}</td>
                  <td class="center">{{ $newsletter->email }}</td>
                  <td class="center">
                    @if($newsletter->status==1)
                      <a href="{{ url('admin/update-newsletter-status/'.$newsletter->id.'/0') }}"><span style="color:green">Activo</span>
                    @else
                      <a href="{{ url('admin/update-newsletter-status/'.$newsletter->id.'/1') }}"><span style="color:red">Inactivo</span></a>
                    @endif
                  </td>
                  <td class="center">{{ $newsletter->created_at }}</td>
                  <td class="center"><a href="{{ url('admin/delete-newsletter-email/'.$newsletter->id.'') }}">Eliminar</a></td>
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
