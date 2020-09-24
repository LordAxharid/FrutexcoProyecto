@extends('layouts.frontLayout.front_design')
@section('content')

<section id="cart_items">
	<div class="container">
	<div class="ogami-breadcrumb">
        <div class="container">
          <ul>
            <li> <a class="breadcrumb-link" href=""> <i class="fas fa-home"></i>Inicio</a></li>
            <li> <a class="breadcrumb-link" href="">Gracias</a></li>
           
          </ul>
        </div>
      </div>
      <!-- End breadcrumb-->
	</div>
</section>

<div class="order-step">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="order-step_block">
                <div class="row no-gutters">
				  <div class="col-12 col-md-4">
                    <div class="step-block active">
                      <div class="step">
                        <h2>Gracias</h2><span>04</span>
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

<div class="order-complete">
        <div class="container">
          <div class="row">
            <div class="col-12 justify-content-center align-items-center text-center">
              <h1>¡Tu cotización ha sido recibida! nos pondremos en contacto lo más pronto posible <br>
			    <span>su número de orden es #{{ Session::get('order_id') }}</span></h1>
            </div>
            <div class="col-12">
              <div class="benefit-block">
                <div class="our-benefits shadowless benefit-border">
                  <div class="row no-gutters">
                    <div class="col-12 col-md-6 col-lg-3">
                      <div class="benefit-detail d-flex flex-column align-items-center"><img class="benefit-img" src="assets/images/homepage01/benefit-icon1.png" alt="">
                        <h5 class="benefit-title">Envíos efectivos</h5>
                        <p class="benefit-describle">Llegan a su destino</p>
                      </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                      <div class="benefit-detail d-flex flex-column align-items-center"><img class="benefit-img" src="assets/images/homepage01/benefit-icon2.png" alt="">
                        <h5 class="benefit-title">Entregas rápidas</h5>
                        <p class="benefit-describle">De los mejores tiempos</p>
                      </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                      <div class="benefit-detail d-flex flex-column align-items-center"><img class="benefit-img" src="assets/images/homepage01/benefit-icon3.png" alt="">
                        <h5 class="benefit-title">Pagos efectivos</h5>
                        <p class="benefit-describle">100% Efectivos</p>
                      </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                      <div class="benefit-detail boderless boderless d-flex flex-column align-items-center"><img class="benefit-img" src="assets/images/homepage01/benefit-icon4.png" alt="">
                        <h5 class="benefit-title">Atención personalizada</h5>
                        <p class="benefit-describle">Respuesta en menos de 24 horas </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

@endsection

<?php
Session::forget('grand_total');
Session::forget('order_id');
?>
