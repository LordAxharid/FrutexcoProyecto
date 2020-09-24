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
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Páginas de CMS</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>ID de página</th>
                  <th>Título</th>
                  <th>URL</th>
                  <th>Estado</th>
                  <th>Creado en</th>
                  <th>Comportamiento</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($cmsPages as $page)
                <tr class="gradeX">
                  <td class="center">{{ $page->id }}</td>
                  <td class="center">{{ $page->title }}</td>
                  <td class="center">{{ $page->url }}</td>
                  <td class="center">@if($page->status==1) Active @else Inactive @endif</td>
                  <td class="center">{{ $page->created_at }}</td>
                  <td class="center">
                    <a href="#myModal{{ $page->id }}" data-toggle="modal" class="btn btn-success btn-mini">Ver</a>
                    <a href="{{ url('/admin/edit-cms-page/'.$page->id) }}" class="btn btn-primary btn-mini"><i class="mdi mdi-grease-pencil"></i></a>
                    <a href="{{ url('/admin/delete-cms-page/'.$page->id) }}" class="btn btn-danger btn-mini"><i class="mdi mdi-delete"></i></a>
                        <div id="myModal{{ $page->id }}" class="modal hide">
                          <div class="modal-header">
                            <button data-dismiss="modal" class="close" type="button">×</button>
                            <h3>{{ $page->title }} Page Details</h3>
                          </div>
                          <div class="modal-body">
                            <p><strong>Title:</strong> {{ $page->title }}</p>
                            <p><strong>URL:</strong> {{ $page->url }}</p>
                            <p><strong>Status:</strong> @if($page->status==1) Active @else Inactive @endif</p>
                            <p><strong>Created on:</strong> {{ $page->created_at }}</p>
                            <p><strong>Descripción:</strong> {{ $page->description }}</p>
                          </div>
                        </div>

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
