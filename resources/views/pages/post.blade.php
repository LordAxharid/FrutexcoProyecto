@extends('layouts.frontLayout.front_design')
@section('content')
<section>
<div class="contact-us">

@if(Session::has('flash_message_success'))
			            <div class="alert alert-success alert-block">
			                <button type="button" class="close" data-dismiss="alert">×</button>
			                    <strong>{!! session('flash_message_success') !!}</strong>
			            </div>
			        @endif
			        @if ($errors->any())
					    <div class="alert alert-danger">
					        <ul>
					            @foreach ($errors->all() as $error)
					                <li>{{ $error }}</li>
					            @endforeach
					        </ul>
					    </div>
					@endif

        <div class="container">
          <div class="feature map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d994.1450415062982!2d-74.1571049!3d4.668689!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x6a81713b05f74aa1!2sFRUTEXCO%20S.A.S!5e0!3m2!1ses-419!2sco!4v1588656075110!5m2!1ses-419!2sco"></iframe>
          </div>
          <div class="contact-method">
            <div class="row">
              <div class="col-12 col-md-4">
                <div class="method-block"><i class="icon_pin_alt"></i>
                  <div class="method-block_text">
                    <p>	Cra. 104 #13 D 48</p>
                    <p>Bogotá, Cundinamarca</p>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-4">
                <div class="method-block"><i class="icon_mail_alt"></i>
                  <div class="method-block_text">
                    <p> <span>Telefono:</span>+57 3123776063</p>
                    <p><span>Email:</span>Director@frutexco.com</p>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-4">
                <div class="method-block"><i class="icon_clock_alt"></i>
                  <div class="method-block_text">
                    <p> <span>Lunes a Sabado:</span>08:00AM – 08:00Pm</p>
                    <p><span>Domingo:</span>Cerrado</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
   
          <div class="leave-message">
          <div class="status alert alert-success" style="display: none"></div>
            <h1 class="title">Contactanos</h1>
            <p>Envianos un mensaje lo responderemos lo mas pronto posible</p>
            <form name="contact-form" v-on:submit.prevent="contact" action="contact" method="post">{{ csrf_field() }}
              <div class="row">
                <div class="col-12 col-md-6">
                  <input class="no-round-input"	name="name" type="text" placeholder="Nombre">
                </div>
                <div class="col-12 col-md-6">
                  <input class="no-round-input"	name="email" type="email" placeholder="Email">
                </div>
                <div class="col-12 col-md-6">
                  <input class="no-round-input"	name="subject" type="text" placeholder="Nombre">
                </div>
                <div class="col-12">
                  <textarea class="textarea-form" name="message" cols="30" rows="10" placeholder="Tu mensaje"></textarea>
                </div>
                <div class="col-12">
                <button type="submit" class="btn btn-primary pull-right">Enviar!</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>





</section>

@endsection
