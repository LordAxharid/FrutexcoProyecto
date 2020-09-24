<?php
use App\Http\Controllers\Controller;
$mainCategories =  Controller::mainCategories();
?>
	  <footer>
	  <div class="newletter">
        <div class="container">
          <div class="row">
            <div class="col-12 col-sm-12 col-md-4 text-sm-center text-md-left">
			<br>
              <div class="footer-logo"><img src="{{ asset('images/frontend_images/home/FRUTEXCO.png') }}" alt=""></div>
              <div class="footer-contact">
			 	<p>	Cra. 104 ##13 D 48, Bogotá, Cundinamarca</p>
				<p>Teléfono: +57 3123776063</p>
				<p>Email: Director@frutexco.com</p>
              </div>
              <div class="footer-social">
			  <a class="round-icon-btn" href=""><i class="fab fa-facebook-f"> </i></a>
			  <a class="round-icon-btn" href=""><i class="fab fa-twitter"></i></a>
			  <a class="round-icon-btn" href=""><i class="fab fa-instagram"></i></a></div>
            </div>
            <div class="col-md-8">
              <div class="row">
                <div class="col-12 col-sm-4 text-sm-center text-md-left">
                  <div class="footer-quicklink">
                    <h5>Categorías</h5>
					@foreach($mainCategories as $cat)
					<a href="{{ asset('products/'.$cat->url) }}">{{ $cat->name }}</a>
					@endforeach
                  </div>
                </div>
                <div class="col-12 col-sm-4 text-sm-center text-md-left">
                  <div class="footer-quicklink">
                    <h5>Políticas</h5>
					<a href="{{ url('page/terms-conditions') }}">Términos & condiciones </a>
					<a href="{{ url('page/privacy-policy') }}">Políticas de privacidad</a>
                  </div>
                </div>
                <div class="col-12 col-sm-4 text-sm-center text-md-left">
                  <div class="footer-quicklink">
                    <h5>Acerca de nosotros</h5>
					<a href="{{ url('About') }}">Acerca de nosotros</a>
					<a href="{{ url('page/post') }}">Contactanos</a>
					
				  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
		</div>
      
        <div class="footer-credit">
          <div class="container">
            <div class="footer-creadit_block d-flex flex-column flex-md-row justify-content-start justify-content-md-between align-items-baseline align-items-md-center">
              <p class="author"></p><img class="payment-method" src="assets/images/payment.png" alt="">
			  <p class="pull-right">Diseñado por: John Jairo Medina,Daniel Alvarez Barrios, Henry Osman Vega<span><a target="_blank" href="#"></a></span></p>
			</div>
          </div>
        </div>
      </footer>
      <!-- End footer-->



	<script>
		function checkSubscriber(){
			var subscriber_email = $("#subscriber_email").val();
			$.ajax({
				type:'post',
				url:'/check-subscriber-email',
				data:{subscriber_email:subscriber_email},
				success:function(resp){
					if(resp=="exists"){
						/*alert("Subscriber email already exists");*/
						$("#statusSubscribe").show();
						$("#btnSubmit").hide();
						$("#statusSubscribe").html("<div style='margin-top:-10px;'>&nbsp;</div><font color='red'>Error: Subscriber email already exists!</font>");
					}

				},error:function(){
					alert("Error");
				}
			});
		}

		function addSubscriber(){
			var subscriber_email = $("#subscriber_email").val();
			$.ajax({
				type:'post',
				url:'/add-subscriber-email',
				data:{subscriber_email:subscriber_email},
				success:function(resp){
					if(resp=="exists"){
						/*alert("Subscriber email already exists");*/
						$("#statusSubscribe").show();
						$("#btnSubmit").hide();
						$("#statusSubscribe").html("<div style='margin-top:-10px;'>&nbsp;</div><font color='red'>Error: Subscriber email already exists!</font>");
					}else if(resp=="saved"){
						$("#statusSubscribe").show();
						$("#statusSubscribe").html("<div style='margin-top:-10px;'>&nbsp;</div><font color='green'>Success: Thanks for Subscribing!</font>");
					}

				},error:function(){
					alert("Error");
				}
			});
		}

		function enableSubscriber(){
			$("#btnSubmit").show();
			$("#statusSubscribe").hide();
		}
	</script>
