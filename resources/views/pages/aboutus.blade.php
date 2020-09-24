@extends('layouts.frontLayout.front_design')

@section('content')

<div class="about-us">
        <div class="container">
          <div class="our-story">
            <div class="row">
              <div class="col-12 col-md-6">
                <div class="our-story_text">
                  <h1 class="title green-underline">Bienvenido a Frutexco</h1>
              <p><font face="Cera Pro Bold">Somos una empresa especializada en fruta fresca en el sector agroalimentario en Colombia, agricultura y calidad asegurada.</font></p>
							<p><font face="Cera Pro Bold">Nuestro equipo tiene más de 12 años de experiencia en exportación de productos perecederos</font></p>
							<h1><font face="Cera Pro Bold">Misión</font></h1>
							<p><font face="Cera Pro Bold">Satisfacer las necesidades de nuestros clientes y consumidores mejorando el nivel de vida de los mismos, ofreciéndoles productos de excelente calidad, mediante la producción, y exportación de productos agrícolas, A la vez contribuir con el desarrollo de nuestros colaboradores, agricultores y proveedores en nuestro país.</font></p>
							<h1><font face="Cera Pro Bold">Visión</font></h1>
							<p><font face="Cera Pro Bold">Ser líder en comercialización y exportación de productos frutales y ser reconocido como una de las mejores empresas de exportación en Colombia</font></p>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="our-story_video">
				<img src="{{ asset('images/frontend_images/aboutus/QuienesSomos (1).jpg') }}" alt="play video">
				</div>
              </div>
            </div>
          </div>
          <div class="our-number">
            <div class="row">
              <div class="col-md-4">
                <div class="our-number_block">
                  <div class="our-number_icon"><img src="{{ asset('images/frontend_images/pages/about_us_icon_1.png') }}" alt="icon"></div>
                  <div class="our-number_info">
                    <h1 class="nummber-increase"><span class="numscroller" data-min="1" data-max="40" data-delay="5" data-increment="10">40</span>%</h1>
                    <p><font face="Cera Pro Bold">Clientes satisfechos</font></p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="our-number_block">
                  <div class="our-number_icon"><img src="{{ asset('images/frontend_images/pages/about_us_icon_2.png') }}" alt="icon"></div>
                  <div class="our-number_info">
                    <h1 class="nummber-increase"><span class="numscroller" data-min="1" data-max="40" data-delay="5" data-increment="10">2</span></h1>
                    <p><font face="Cera Pro Bold">Nuestro personal</font></p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="our-number_block">
                  <div class="our-number_icon"><img src="{{ asset('images/frontend_images/pages/about_us_icon_3.png') }}" alt="icon"></div>
                  <div class="our-number_info">
                    <h1 class="nummber-increase">+<span class="numscroller" data-min="1" data-max="40" data-delay="5" data-increment="10">40</span></h1>
                    <p><font face="Cera Pro Bold">40</font></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="container">
          <div class="our-farmer">
            <h1 class="title green-underline">Fundadores</h1>
            <div class="row">
              <div class="col-sm-6 col-lg-3">
                <div class="our-farmer-block our-farmer-block--1">
                  <div class="farmer-img"><img src="{{ asset('images/frontend_images/aboutus/mision.png') }}" alt="farmer"></div>
                  <div class="farmer-contact_wrapper">
                    <div class="farmer-contact">
                      <h2>Ferney Pineda</h2>
                      <h5>Ferney</h5>
                      <div class="farmer-social"><a href=""><i class="fab fa-facebook-f"> </i></a><a href=""><i class="fab fa-twitter"></i></a><a href=""><i class="fab fa-invision"> </i></a><a href=""><i class="fab fa-pinterest-p"></i></a></div>
                    </div>
                  </div>
                </div>
              </div>
   
              <div class="col-sm-6 col-lg-3">
                <div class="our-farmer-block our-farmer-block--4">
                  <div class="farmer-img"><img src="{{ asset('images/frontend_images/aboutus/vision.png') }}" alt="farmer"></div>
                  <div class="farmer-contact_wrapper">
                    <div class="farmer-contact">
                      <h2>Henry Pineda</h2>
                      <h5>Henry</h5>
                      <div class="farmer-social"><a href=""><i class="fab fa-facebook-f"> </i></a><a href=""><i class="fab fa-twitter"></i></a><a href=""><i class="fab fa-invision"> </i></a><a href=""><i class="fab fa-pinterest-p"></i></a></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>



    @endsection
