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
    <h3>Preguntas Frecuentes</h3>
    <hr>
  <div style="margin-left:20px;">
    <a href="{{ url('/admin/export-faqs') }}" class="btn btn-primary btn-mini">Exportar Faqs</a>
  </div>

  <form action="{{ url('/admin/import-faqs') }}" method="post" enctype="multipart/form-data">
  @csrf
<input type="file" name="file">

<button class="btn btn-primary btn-mini">Importar Faqs</button>

</form>



    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Ver preguntas</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>IdFaq</th>
                  <th>Pregunta</th>
                  <th>Respuesta</th>
                  <th>Estado</th>
                  <th>Fecha creación</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($Faq as $Faq)
                <tr class="gradeX">
                  <td class="center">{{ $Faq->id }}</td>
                  <td class="center">{{ $Faq->ask }}</td>
                  <td class="center">{{ $Faq->answer }}</td>
                  <td class="center">
                    @if($Faq->status==1)
                      <span style="color:green">Activo</span>
                    @else
                      <span style="color:red">Inactivo</span>
                    @endif
                  </td>

                  <td class="center">{{ $Faq->created_at }}</td>
                  <td class="center">
                    <a href="{{ url('/admin/edit-faq/'.$Faq->id) }}" class="btn btn-primary btn-mini"><i class="mdi mdi-grease-pencil"></i></a>
                    <a id="delfaq" rel="{{ $Faq->id }}" rel1="delete-faq" href="javascript:" class="btn btn-danger btn-mini deleteRecord"><i class="mdi mdi-delete"></i></a>
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
