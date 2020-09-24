@extends('layouts.frontLayout.front_design')
@section('content')

  <div class="container">
   <section id="formHolder">

   @if(Session::has('flash_message_success'))
	            <div class="alert alert-success alert-block">
	                <button type="button" class="close" data-dismiss="alert">×</button>
	                    <strong class="fuenteLetrica">{!! session('flash_message_success') !!}</strong>
	            </div>
	        @endif
	        @if(Session::has('flash_message_error'))
	            <div class="alert alert-error alert-block" style="background-color:#f4d2d2">
	                <button type="button" class="close" data-dismiss="alert">×</button>
	                    <strong class="fuenteLetrica">{!! session('flash_message_error') !!}</strong>
	            </div>
    		@endif
      <div class="row">
         <!-- Brand Box -->
         <div class="col-sm-6 brand">
        

            <div class="heading">
               <h2>Frutexco</h2>
               <p>Fruit export</p>
            </div>

            <div class="success-msg">
               <p>Great! You are one of our members now</p>
               <a href="#" class="profile">Your Profile</a>
            </div>
         </div>


         <!-- Form Box -->
         <div class="col-sm-6 form">

            <!-- Fomulario de ingreso -->
            <div class="login form-peice switched">
               <form id="loginForm" class="login-form" name="loginForm" action="{{ url('/user-login') }}" method="post">{{ csrf_field() }}
               <h1 class="title">Iniciar sesión</h1><br>
               <div class="form-group">
                 <h2 class="text-dark fuenteLetrica">Correo electrónico</h2><br>
                     <input name="email" type="email" placeholder="Correo Electronico" required="" />
                  </div>
<br>
                  <div class="form-group">
                  <h2 class="text-dark fuenteLetrica">Contraseña</h2><br>
                     <input name="password" type="password" placeholder="Contraseña" required="" />
                  </div>
<br><br>
                  <div class="CTA">
                     <button type="submit" class="no-round-btn float-right "value="Ingresar">Ingresar</button>
                     
                     <a href="#" class="switch">Registrarse</a>
                     <a style="font-family: 'Cera Pro Bold'" class="btn btn-light" href="{{ url('forgot-password') }}">¿Olvidó la contraseña?</a>
                  </div>
               </form>
            </div><!-- End Login Form -->


            <!-- Formulario de registro -->
            <div class="signup form-peice">
               <form id="registerForm" name="registerForm" action="{{ url('/user-register') }}" method="POST">{{ csrf_field() }}
                  <h1 class="title">Registrarse</h1>
                  <div class="form-group">
                  <h2 class="text-dark fuenteLetrica">Nombre</h2><br>
                     <input id="name" name="name" type="text" placeholder="Nombre"/>
                     <span class="error"></span>
                  </div>
<br>
                  <div class="form-group">
                  <h2 class="text-dark fuenteLetrica">Correo electrónico</h2><br>
                     <input id="email" name="email" type="email" placeholder="Correo electrónico"/>
                     <span class="error"></span>
                  </div>
<br>
                  <div class="form-group"><br>
                  <h2 class="text-dark fuenteLetrica">Contraseña</h2><br>
                     <input id="myPassword" name="password" type="password" placeholder="Contraseña"/>
                     <span class="error"></span>
                  </div>
                  <div class="CTA">
                  <h1 style="font=size: .875rem; color: rgba(0,0,0,.46);">Al hacer clic en registrarme acepta los <a style="text-decoration: none; color: #3483fa" href="page/terms-conditions" target="_blank"> Términos y Condiciones</a><h1>
                  </div>
<br>
                  <div class="CTA">
                
                  <button type="submit" class="no-round-btn float-right">Registrarme</button><br>
                     <h1><a class="switch">Ya Tengo Cuenta</a><h1>
                  </div>
               </form>
            </div><!-- End Signup Form -->
         </div>
      </div>

   </section>



</div>

@endsection
