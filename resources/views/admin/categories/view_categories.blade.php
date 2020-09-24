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
    <h3>Categorías</h3>
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Categorías</h5>
          </div>
          <div class="table-responsive">
          <div class="widget-content nopadding ">
            <table class="table table-bordered data-table ">
              <thead>
                <tr>
                  <th>Categoría id</th>
                  <th>Categoría nombre</th>
                  <th>Nivel</th>
                  <th>Categoría url</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($categories as $category)
                <tr class="gradeX">
                  <td class="center">{{ $category->id }}</td>
                  <td class="center">{{ $category->name }}</td>
                  <td class="center">{{ $category->parent_id }}</td>
                  <td class="center">{{ $category->url }}</td>
                  <td class="center">
                    @if(Session::get('adminDetails')['categories_edit_access']==1)
                    <a href="{{ url('/admin/edit-category/'.$category->id) }}" class="btn btn-primary btn-mini"><i class="mdi mdi-grease-pencil"></i></a> 
                    @endif
                    @if(Session::get('adminDetails')['categories_full_access']==1)
                    <a <?php /* id="delCat" href="{{ url('/admin/delete-category/'.$category->id) }}" */ ?> rel="{{ $category->id }}" rel1="delete-category" href="javascript:" class="btn btn-danger btn-mini deleteRecord"><i class="mdi mdi-delete"></i></a></td>
                    @endif
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
</div>

@endsection