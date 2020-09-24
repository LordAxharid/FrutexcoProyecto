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
    <h3>Usuarios</h3>
    <hr>
  <div style="margin-left:20px;">
    <a href="{{ url('/admin/export-users') }}" class="btn btn-primary btn-mini">Exportar</a>
  </div>
  

    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Usuarios</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table table-responsive">
              <thead>
                <tr>
                  <th>ID de usuario</th>
                  <th>Nombre</th>
                  <th>Dirección</th>
                  <th>Ciudad</th>
                  <th>Estado</th>
                  <th>Pais</th>
                  <th>Código pin</th>
                  <th>Móvil celular</th>
                  <th>Correo electrónico</th>
                  <th>Estado</th>
                  <th>Registrado el</th>
                  <th>Estado edit</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($users as $user)
                <tr class="gradeX">
                  <td class="center">{{ $user->id }}</td>
                  <td class="center">{{ $user->name }}</td>
                  <td class="center">{{ $user->address }}</td>
                  <td class="center">{{ $user->city }}</td>
                  <td class="center">{{ $user->state }}</td>
                  <td class="center">{{ $user->country }}</td>
                  <td class="center">{{ $user->pincode }}</td>
                  <td class="center">{{ $user->mobile }}</td>
                  <td class="center">{{ $user->email }}</td>
                  <td class="center">
                    @if($user->status==1)
                      <span style="color:green">Activo</span>
                    @else
                      <span style="color:red">Inactivo</span>
                    @endif
                  </td>
                  <td class="center">{{ $user->created_at }}</td>

                 <td class="center"><a href="{{ url('/admin/update-status-users/'.$user->id) }}" class="btn btn-primary btn-mini"><i class="mdi mdi-grease-pencil"></i></a><td>
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
