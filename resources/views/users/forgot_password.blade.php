@extends('layouts.frontLayout.front_design')
@section('content')
<div class="container">
   <section id="formHolder">
	   
   @if(Session::has('flash_message_success'))
	            <div class="alert alert-success alert-block">
	                <button type="button" class="close" data-dismiss="alert">×</button>
	                    <strong>{!! session('flash_message_success') !!}</strong>
	            </div>
	        @endif
	        @if(Session::has('flash_message_error'))
	            <div class="alert alert-error alert-block" style="background-color:#f4d2d2">
	                <button type="button" class="close" data-dismiss="alert">×</button>
	                    <strong>{!! session('flash_message_error') !!}</strong>
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
            <div class="signup form-peice">
               <form id="forgotPasswordForm" class="login-form" name="forgotPasswordForm" action="{{ url('/forgot-password') }}" method="post">{{ csrf_field() }}
                  <div class="form-group">
				  <h2 class="text-dark fuenteLetrica">Correo Electrónico:</h2><br>
                     <input name="email" type="email" placeholder="Correo Electronico" required="">
                  </div>
				  <div class="CTA">
                     <input type="submit" value="Recuperar contraseña" id="submit">
					 <a  class="switch btn btn-success text-white">Registrarse</a>
                  </div>
               </form>
            </div><!-- End Login Form -->


            <!-- Formulario de registro -->
            <div class="login form-peice switched">
               <form id="registerForm" name="registerForm" class="signup-form" action="{{ url('/user-register') }}" method="POST">{{ csrf_field() }}

                  <div class="form-group">
				   <h2 class="text-dark fuenteLetrica">Nombre:</h2><br>
                     <input id="name" name="name" type="text" placeholder="Nombre"/>
                     <span class="error"></span>
                  </div>
				  <br>
                  <div class="form-group">
				  <h2 class="text-dark fuenteLetrica">Correo Electrónico:</h2><br>
                     <input id="email" name="email" type="email" placeholder="Correo Electronico"/>
                     <span class="error"></span>
                  </div>
				  <br>
                  <div class="form-group">
				  <h2 class="text-dark fuenteLetrica">Contraseña:</h2><br>
                     <input id="myPassword" name="password" type="password" placeholder="Contraseña"/>
                     <span class="error"></span>
                  </div>
                  <div class="CTA">
                     <input type="submit" value="Registrarse" id="submit">
                     <a class="switch btn btn-success text-white">Recuperar contraseña</a>
                  </div>
               </form>
            </div><!-- End Signup Form -->
         </div>
      </div>

   </section>




@endsection



