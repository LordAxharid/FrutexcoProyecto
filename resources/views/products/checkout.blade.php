@extends('layouts.frontLayout.front_design')
@section('content')

<section id="form" style="margin-top:20px;"><!--Formulario-->
	<div class="container">
	<div class="ogami-breadcrumb">
        <div class="container">
          <ul>
            <li> <a class="breadcrumb-link" href=""> <i class="fas fa-home"></i>Inicio</a></li>
            <li> <a class="breadcrumb-link" href="">Carrito</a></li>
            <li> <a class="breadcrumb-link active" href="">Ingreso dirección</a></li>
          </ul>
        </div>
      </div>
		@if(Session::has('flash_message_error'))
            <div class="alert alert-error alert-block" style="background-color:#f4d2d2">
                <button type="button" class="close" data-dismiss="alert">×</button>
				<font face="Cera Pro Bold"><strong>{!! session('flash_message_error') !!}</strong></font>
            </div>
		@endif

		<div class="order-step">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="order-step_block">
                <div class="row no-gutters">
                  <div class="col-12 col-md-4">
                    <div class="step-block">
                      <div class="step">
                        <h2>Carrito de compra</h2><span>01</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-4">
                    <div class="step-block active">
                      <div class="step">
                        <h2>Ingresar dirección</h2><span>02</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-4">
                    <div class="step-block">
                      <div class="step">
                        <h2>Confirmar cotización</h2><span>03</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End order step-->
<div class="center-block">
		<form action="{{ url('/checkout') }}" method="post">{{ csrf_field() }}
			<div class="row">
				<div class="col-sm-5 col-sm-offset-1">
					<div class="login-form"><!--Formulario de inicio-->
						<h2><font face="Cera Pro Bold">Cobrar A</font></h2><br>
							<div class="form-group">
							<font face="Cera Pro Bold"><input name="billing_name" id="billing_name" @if(!empty($userDetails->name)) value="{{ $userDetails->name }}" @endif type="text" placeholder="Nombre De Comprador" class="no-round-input-bg" /></font>
							</div>
							<div class="form-group">
							<font face="Cera Pro Bold"><input name="billing_address" id="billing_address" @if(!empty($userDetails->address)) value="{{ $userDetails->address }}" @endif type="text" placeholder="Direccion De Comprador" class="no-round-input-bg" /></font>
							</div>
							<div class="form-group">
							<font face="Cera Pro Bold"><input name="billing_city" id="billing_city" @if(!empty($userDetails->city)) value="{{ $userDetails->city }}" @endif type="text" placeholder="Ciudad Del Comprador" class="no-round-input-bg" /></font>
							</div>
							<div class="form-group">
							<font face="Cera Pro Bold"><input name="billing_state" id="billing_state" @if(!empty($userDetails->state)) value="{{ $userDetails->state }}" @endif type="text" placeholder="Departamento Del Comprador" class="no-round-input-bg" /></font>
							</div>
							<div class="form-group">
							<font face="Cera Pro Bold"><select id="billing_country" name="billing_country" class="no-round-input-bg">
									<option value="">Selecciona El Pais</option>
									@foreach($countries as $country)
										<option value="{{ $country->country_name }}" @if(!empty($userDetails->country) && $country->country_name == $userDetails->country) selected @endif>{{ $country->country_name }}</option>
									@endforeach
								</select></font>
							</div>
							<div class="form-group">
							<font face="Cera Pro Bold"><input name="billing_pincode" id="billing_pincode" @if(!empty($userDetails->name)) value="{{ $userDetails->pincode }}" @endif type="text" placeholder="Codigo Postal Del Comprador" class="no-round-input-bg" /></font>
							</div>
							<div class="form-group">
							<font face="Cera Pro Bold"><input name="billing_mobile" id="billing_mobile" @if(!empty($userDetails->mobile)) value="{{ $userDetails->mobile }}" @endif type="text" placeholder="Telefono Del Comprador" class="no-round-input-bg" /></font>
							</div>
							<div class="form-check">
							    <input type="checkbox" class="form-check-input" id="copyAddress">
							    <label class="form-check-label" for="copyAddress"><font face="Cera Pro Bold">Enviar a la dirección ingresada?</font></label>
							</div>
					</div><!--/Formulario de inicio-->
				</div>
				<div class="col-sm-1">
					<h2></h2>
				</div>
				<div class="col-sm-5">
					<div class="signup-form"><!--formulario de registro-->
						<h2><font face="Cera Pro Bold">Enviar A</font></h2><br>
							<div class="form-group">
							<font face="Cera Pro Bold">	<input name="shipping_name" id="shipping_name" @if(!empty($shippingDetails->name)) value="{{ $shippingDetails->name }}" @endif type="text" placeholder="Nombre Destinatario" class="no-round-input-bg" /></font>
							</div>
							<div class="form-group">
							<font face="Cera Pro Bold"><input name="shipping_address" id="shipping_address" @if(!empty($shippingDetails->address)) value="{{ $shippingDetails->address }}" @endif type="text" placeholder="Direccion Del Destinatario" class="no-round-input-bg" /></font>
							</div>
							<div class="form-group">
							<font face="Cera Pro Bold"><input name="shipping_city" id="shipping_city" @if(!empty($shippingDetails->city)) value="{{ $shippingDetails->city }}" @endif type="text" placeholder="Ciudad De Destinatario" class="no-round-input-bg" /></font>
							</div>
							<div class="form-group">
							<font face="Cera Pro Bold"><input name="shipping_state" id="shipping_state" @if(!empty($shippingDetails->state)) value="{{ $shippingDetails->state }}" @endif type="text" placeholder="Departamento Del Destinatario" class="no-round-input-bg" /></font>
							</div>
							<font face="Cera Pro Bold"><div class="form-group">
								<select id="shipping_country" name="shipping_country" class="no-round-input-bg">
								<option value="">Seleccionar Pais</option>
									@foreach($countries as $country)
								<option value="{{ $country->country_name }}" @if(!empty($shippingDetails->country) && $country->country_name == $shippingDetails->country) selected @endif>{{ $country->country_name }}</option>
									@endforeach
								</select>
							</div></font>
							<div class="form-group">
							<font face="Cera Pro Bold"><input name="shipping_pincode" id="shipping_pincode" @if(!empty($shippingDetails->pincode)) value="{{ $shippingDetails->pincode }}" @endif type="text" placeholder="Codigo Postal Destinatario" class="no-round-input-bg" /></font>
							</div>
							<div class="form-group">
							<font face="Cera Pro Bold"><input name="shipping_mobile" id="shipping_mobile" @if(!empty($shippingDetails->mobile)) value="{{ $shippingDetails->mobile }}" @endif type="text" placeholder="Telefono Destinatario" class="no-round-input-bg" /></font>
							</div>
							<button style="position: absolute;left: 54%;" type="submit" class="btn btn-warning text-white"><font face="Cera Pro Bold">Confirmar cotización</font></button><br>
					</div><!--/formulario de registro-->
				</div>
			</div>
		</form>
	</div>
	</div>

	
</section><!--/Formulario-->
</div>
</div>
</div></br></br>
@endsection
