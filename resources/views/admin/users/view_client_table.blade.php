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
    <h3>Página editar permiso cliente</h3>
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Página para editar permiso cliente</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                <th>ID de usuario</th>
                  <th>Nombre</th>
                  <th>Correo electrónico</th>
                  <th>Cliente</th>
                  <th>Estado</th>
                  <th>Fecha de registro</th>
                  <th>Acciones</th>

                </tr>
              </thead>
              <tbody>
              @foreach($users as $user)
                <tr class="gradeX">
                  <td class="center">{{ $user->id }}</td>
                  <td class="center">{{ $user->name }}</td>
                  <td class="center">{{ $user->email }}</td>
                  <td class="center">
                  @if($user->Cliente==1)
                      <span style="color:green">SI</span>
                    @else
                      <span style="color:red">NO</span>
                    @endif
                  </td>

                  <td class="center">
                    @if($user->status==1)
                      <span style="color:green">Activo</span>
                    @else
                      <span style="color:red">Inactivo</span>
                    @endif
                  </td>
                  <td class="center">{{ $user->created_at }}</td>

                  <td class="center">
                  <a href="{{ url('/admin/edit-client-page/'.$user->id) }}" class="btn btn-primary btn-mini"><i class="mdi mdi-grease-pencil"></i></a>
                  </td>
                </tr>

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
