@extends('layouts.frontLayout.front_design')
@section('content')

<div class="ogami-breadcrumb">
        <div class="container">
          <ul>
            <li> <a class="breadcrumb-link" > <i class="fas fa-home"></i>Inicio</a></li>
            <li> <a class="breadcrumb-link active" >404 Error</a></li>
          </ul>
        </div>
      </div>
      <!-- End breadcrumb-->
      <div class="error-404">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-12 col-md-5">
              <h1>Opps! No se pudo encontrar esta pagina</h1>
              <p>Disculpa esta pagina que esta buscando actualmente no la encontramos, la hemos reemplazado o cambiado el nombre</p><a class="normal-btn" href="{{ asset('/') }}">ir a el inicio</a>
            </div>
            <div class="col-10 col-md-7"><img src="{{ asset('images/frontend_images/pages/404_img.png')}}" alt="404 image"></div>
          </div>
        </div>
      </div>

@endsection