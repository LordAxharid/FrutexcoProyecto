@extends('layouts.frontLayout.front_design')
@section('content')

<section id="form" style="margin-top:20px;"><!--form-->
	<div class="container">
		<div class="row">
			@if(Session::has('flash_message_success'))
	            <div class="alert alert-success alert-block">
	                <button type="button" class="close" data-dismiss="alert">×</button> 
					<font face="Cera Pro Bold"><strong>{!! session('flash_message_success') !!}</strong></font>
	            </div>
	        @endif
	        @if(Session::has('flash_message_error'))
	            <div class="alert alert-error alert-block" style="background-color:#f4d2d2">
	                <button type="button" class="close" data-dismiss="alert">×</button> 
					<font face="Cera Pro Bold"><strong>{!! session('flash_message_error') !!}</strong></font>
	            </div>
    		@endif  
			<div class="col-sm-4 col-sm-offset-1">
				<div class="login-form">
				<font face="Cera Pro Bold"><h2>Actualizar Cuenta</h2><br></font>
					<form id="accountForm" name="accountForm" action="{{ url('/account') }}" method="POST">{{ csrf_field() }}
						<font face="Cera Pro Bold"><input value="{{ $userDetails->email }}" readonly="" class="no-round-input" class="no-round-input"/></font><br><br>
						<font face="Cera Pro Bold"><input value="{{ $userDetails->name }}" id="name" name="name" type="text" placeholder="Nombre" class="no-round-input"/></font><br><br>
						<font face="Cera Pro Bold"><input value="{{ $userDetails->address }}" id="address" name="address" type="text" placeholder="Direccion" class="no-round-input"/></font><br><br>
						<font face="Cera Pro Bold"><input value="{{ $userDetails->city }}" id="city" name="city" type="text" placeholder="Ciudad" class="no-round-input"/></font><br><br>
						<font face="Cera Pro Bold"><input value="{{ $userDetails->state }}" id="state" name="state" type="text" placeholder="Estado" class="no-round-input"/></font><br><br>
						<font face="Cera Pro Bold"><select id="country" name="country" class="no-round-input">
							<option value="">Select Country</option>
							@foreach($countries as $country)
								<option value="{{ $country->country_name }}" @if($country->country_name == $userDetails->country) selected @endif>{{ $country->country_name }}</option>
							@endforeach
						</select></font>
						<font face="Cera Pro Bold"><input value="{{ $userDetails->pincode }}" style="margin-top: 10px;" id="pincode" name="pincode" type="text" placeholder="CodigoPostal" class="no-round-input"/></font><br><br>
						<font face="Cera Pro Bold"><input value="{{ $userDetails->mobile }}" id="mobile" name="mobile" type="text" placeholder="Telefono" class="no-round-input"/></font><br><br>
						<button type="submit" class="normal-btn">Actualizar</button><br><br>
					</form>
				</div>
			</div>
			<div class="col-sm-3">
				<h2 class="or">O</h2>
			</div>
			<div class="col-sm-4">
				<div class="signup-form">
				<font face="Cera Pro Bold"><h2>Actualizar contraseña</h2><br></font>
					<form id="passwordForm" name="passwordForm" action="{{ url('/update-user-pwd') }}" method="POST">{{ @csrf_field() }}
					<font face="Cera Pro Bold"><input type="password" name="current_pwd" id="current_pwd" placeholder="Contraseña Actual" class="no-round-input"></font><br><br>
						<span id="chkPwd"></span>
						<font face="Cera Pro Bold"><input type="password" name="new_pwd" id="new_pwd" placeholder="Nueva Contraseña" class="no-round-input"></font><br><br>
						<font face="Cera Pro Bold"><input type="password" name="confirm_pwd" id="confirm_pwd" placeholder="Confirmar Contraseña" class="no-round-input"></font><br><br>
						<button type="submit" class="normal-btn">Actualizar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</section><!--/form-->

@endsection