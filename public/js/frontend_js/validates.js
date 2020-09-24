/*price range*/

$('#sl2').slider();

var RGBChange = function() {
  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
};

/*scroll to top*/

$(document).ready(function(){
$(function () {
    $.scrollUp({
        scrollName: 'scrollUp', // Element ID
        scrollDistance: 300, // Distance from top/bottom before showing element (px)
        scrollFrom: 'top', // 'top' or 'bottom'
        scrollSpeed: 300, // Speed back to top (ms)
        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
        animation: 'fade', // Fade, slide, none
        animationSpeed: 200, // Animation in speed (ms)
        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
                //scrollTarget: false, // Set a custom target element for scrolling to the top
        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
        scrollTitle: false, // Set a custom <a> title if required.
        scrollImg: false, // Set true to use image
        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
        zIndex: 2147483647 // Z-Index for the overlay
    });
});
});



$(document).ready(function(){

// Change Price with Size
$("#selSize").change(function(){
    var idsize = $(this).val();
    if(idsize==""){
        return false;
    }
    $.ajax({
        type:'get',
        url:'/get-product-price',
        data:{idsize:idsize},
        success:function(resp){
            var arr = resp.split('#');
            var arr1 = arr[0].split('-');
            $("#getPrice").html("USD "+arr1[0]+"$ <br>");
            $("#price").val(arr[0]);
            if(arr[1]==0){
                $("#cartButton").hide();
                $("#Availability").text("No Disponible");
            }else{
                $("#cartButton").show();
                $("#Availability").text("Disponible");
            }


        },error:function(){
            alert("Error");
        }
    });
});

// Change Image
$(".changeImage").click(function(){
    var image = $(this).attr('src');
    $("#mainImg").attr("src", image);
    /*$("#mainImgLarge").attr("href", image);*/
});

// Instantiate EasyZoom instances
    var $easyzoom = $('.easyzoom').easyZoom();

    // Setup thumbnails example
    var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

    $('.thumbnails').on('click', 'a', function(e) {
        var $this = $(this);

        e.preventDefault();

        // Use EasyZoom's `swap` method
        api1.swap($this.data('standard'), $this.attr('href'));
    });

    // Setup toggles example
    var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');

    $('.toggle').on('click', function() {
        var $this = $(this);

        if ($this.data("active") === true) {
            $this.text("Switch on").data("active", false);
            api2.teardown();
        } else {
            $this.text("Switch off").data("active", true);
            api2._init();
        }
    });

});


$().ready(function(){
// Validate Register form on keyup and submit
$("#registerForm").validate({
    rules:{
        name:{
            required:true,
            minlength:2,
            accept: "[a-zA-Z]+"
        },
        password:{
            required:true,
            minlength:6
        },
        email:{
            required:true,
            email:true,
            remote:"/check-email"
        }
    },
    messages:{
        name:{
            required:"Por favor ingrese su nombre",
            minlength: "Tu nombre debe de tener mínimo 2 letras",
            accept: "Tu nombre solo puede contener letras "
        },
        password:{
            required:"Por favor escribe tu contraseña",
            minlength: "Su contraseña debe de tener mínimo 6 letras"
        },
        email:{
            required: "Por favor ingresa tu correo electrónico",
            email: "Por favor ingresa un correo valido",
            remote: "El correo electrónico ya existe!"
        }
    }
});

// Validate Register form on keyup and submit
$("#accountForm").validate({
    rules:{
        name:{
            required:true,
            minlength:2,
            accept: "[a-zA-Z]+"
        },
        address:{
            required:true,
            minlength:6
        },
        city:{
            required:true,
            minlength:2
        },
        state:{
            required:true,
            minlength:2
        },
        country:{
            required:true
        }
    },
    messages:{
        name:{
            required:"Por favor ingresa tu nombre",
            minlength: "El nombre debe de tener mino 2 letras",
            accept: "El nombre solo puede tener letras"
        },
        address:{
            required:"Por favor ingresa tu dirección",
            minlength: "Tu dirección debe de tener mínimo 10 caracteres"
        },
        city:{
            required:"Por favor ingrese su ciudad",
            minlength: "La dirección debe de tener mínimo 2 caracteres"
        },
        state:{
            required:"Por favor ingresa el departamento o municipio ",
            minlength: "El departamento o municipio debe de tener mínimo 2 letras"
        },
        country:{
            required:"Por favor selecciona tu país"
        },
    }
});

// Validate Login form on keyup and submit
$("#loginForm").validate({
    rules:{
        email:{
            required:true,
            email:true
        },
        password:{
            required:true
        }
    },
    messages:{
        email:{
            required: "Por favor ingrese su correo",
            email: "Por favor ingrese un correo valido"
        },
        password:{
            required:"Por favor ingrese su contraseña"
        }
    }
});

$("#passwordForm").validate({
    rules:{
        current_pwd:{
            required: true,
            minlength:6,
            maxlength:20
        },
        new_pwd:{
            required: true,
            minlength:6,
            maxlength:20
        },
        confirm_pwd:{
            required:true,
            minlength:6,
            maxlength:20,
            equalTo:"#new_pwd"
        }
    },
    errorClass: "help-inline",
    errorElement: "span",
    highlight:function(element, errorClass, validClass) {
        $(element).parents('.control-group').addClass('error');
    },
    unhighlight: function(element, errorClass, validClass) {
        $(element).parents('.control-group').removeClass('error');
        $(element).parents('.control-group').addClass('success');
    }
});

// Check Current User Password
$("#current_pwd").keyup(function(){
    var current_pwd = $(this).val();
    $.ajax({
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        type:'post',
        url:'/check-user-pwd',
        data:{current_pwd:current_pwd},
        success:function(resp){
            /*alert(resp);*/
            if(resp=="false"){
                $("#chkPwd").html("<font color='red'>La contraseña actual es incorrecta</font>");
            }else if(resp=="true"){
                $("#chkPwd").html("<font color='green'>La contraseña actual es correcta</font>");
            }
        },error:function(){
            alert("Error");
        }
    });
});

// Password Strength Script
$('#myPassword').passtrength({
  minChars: 4,
  passwordToggle: true,
  tooltip: true,
  eyeImg : "/images/frontend_images/eye.svg"
});

// Copy Billing Address to Shipping Address Script
$("#copyAddress").click(function(){
    if(this.checked){
        $("#shipping_name").val($("#billing_name").val());
        $("#shipping_address").val($("#billing_address").val());
        $("#shipping_city").val($("#billing_city").val());
        $("#shipping_state").val($("#billing_state").val());
        $("#shipping_pincode").val($("#billing_pincode").val());
        $("#shipping_mobile").val($("#billing_mobile").val());
        $("#shipping_country").val($("#billing_country").val());
    }else{
        $("#shipping_name").val('');
        $("#shipping_address").val('');
        $("#shipping_city").val('');
        $("#shipping_state").val('');
        $("#shipping_pincode").val('');
        $("#shipping_mobile").val('');
        $("#shipping_country").val('');
    }
});

});

function selectPaymentMethod(){
if($('#Paypal').is(':checked') || $('#COD').is(':checked') || $('#Payumoney').is(':checked')){
}else{
    alert("Por Favor Selecciona Un Metodo De Pago");
    return false;
}
}

/*function checkPincode(){
var pincode = $("#chkPincode").val();
if(pincode==""){
    alert("Por Favor Ingresa El Codigo Postal"); return false;
}
$.ajax({
    type:'post',
    data:{pincode:pincode},
    url:'/check-pincode',
    success:function(resp){
        if(resp>0){
            $("#pincodeResponse").html("<font color='green'>Este Codigo Postal Esta Disponible Para Envio</font>");
        }else{
            $("#pincodeResponse").html("<font color='red'>Este Codigo Postal No Esta Disponible Para Envio</font>");
        }
    },error:function(){
        alert("Error");
    }
});
}
*/

$(".accordion-titulo").click(function(){

var contenido=$(this).next(".accordion-content");

if(contenido.css("display")=="none"){ //open
  contenido.slideDown(250);
  $(this).addClass("open");
}
else{ //close
  contenido.slideUp(250);
  $(this).removeClass("open");
}

});


