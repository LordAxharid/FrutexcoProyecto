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
    <h3>Noticias</h3>
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
                  <th>IdNoticia</th>
                  <th>Titulo</th>
                  <th>Imagen</th>
                  <th>Descripción notica</th>
                  <th>Estado</th>
                  <th>Fecha creación</th>
                  <th>Fecha de actualización</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($New as $New)
                <tr class="gradeX">
                  <td class="center">{{ $New->id }}</td>
                  <td class="center">{{ $New->title }}</td>
                  <td class="center">
                  @if(!empty($New->image))
                    <img src="{{ asset('/images/frontend_images/news/'.$New->image) }}" style="width:250px;">
                    @endif</td>
                  <td class="center">{{ $New->newDescription }}</td>
                  <td class="center">{{ $New->status }}</td>
                  <td class="center">{{ $New->created_at }}</td>
                  <td class="center">{{ $New->updated_at}}</td>
                  <td class="center">
                    <a href="{{ url('/admin/edit-news/'.$New->id) }}" class="btn btn-primary btn-mini"><i class="mdi mdi-grease-pencil"></i></a>
                    <a id="delnew" rel="{{ $New->id }}" rel1="delete-new" href="javascript:" <?php /* href="{{ url('/admin/delete-banner/'.$banner->id) }}" */ ?> class="btn btn-danger btn-mini deleteRecord"><i class="mdi mdi-delete"></i></a>
                  </td>
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
