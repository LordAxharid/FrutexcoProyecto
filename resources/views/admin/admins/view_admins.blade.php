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
    <h3>Administrador /sub-administrador</h3>
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Administrador /sub-administrador</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th style="text-align: left">ID</th>
                  <th style="text-align: left">Nombre de administrador</th>
                  <th style="text-align: left">Tipos de administrador</th>
                  <th style="text-align: left">Roles</th>
                  <th style="text-align: left">Estado</th>
                  <th style="text-align: left">Creado en</th>
                  <th style="text-align: left">Actualizado en</th>
                  <th style="text-align: left">Acciones</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($admins as $admin)
                <?php if($admin->type=="Admin"){
                  $roles = "All";
                }else{
                  $roles = "";
                  if($admin->categories_access==1){
                    $roles .= "Categories, ";
                  }
                  if($admin->products_access==1){
                    $roles .= "Products, ";
                  }
                  if($admin->orders_access==1){
                    $roles .= "Orders, ";
                  }
                  if($admin->users_access==1){
                    $roles .= "Users, ";
                  }
                }
                ?>
                <tr class="gradeX">
                  <td class="center">{{ $admin->id }}</td>
                  <td class="center">{{ $admin->username }}</td>
                  <td class="center">{{ $admin->type }}</td>
                  <td class="center">{{ $roles }}</td>
                  <td class="center">
                    @if($admin->status==1)
                      <span style="color:green">Activo</span>
                    @else
                      <span style="color:red">Inactivo</span>
                    @endif
                  </td>
                  <td class="center">{{ $admin->created_at }}</td>
                  <td class="center">{{ $admin->updated_at }}</td>
                  <td class="center">
                    <a href="{{ url('/admin/edit-admin/'.$admin->id) }}" class="btn btn-primary btn-mini"><i class="mdi mdi-grease-pencil"></i></a>
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
