// Back to top y Carrousel
$(document).ready(function () {
  var amountScrolled = 150;
  var botonArriba = document.getElementById("back-to-top");

  $(window).scroll(function () {
    if ($(window).scrollTop() > amountScrolled) {
      botonArriba.classList.add("show");
    } else {
      botonArriba.classList.remove("show");
    }
  });

  $('.customer-logos').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 4500,
    arrows: false,
    dots: false,
    pauseOnHover: false,
    responsive: [{
      breakpoint: 1025,
      settings: {
        slidesToShow: 4
      }
    }, {
      breakpoint: 990,
      settings: {
        slidesToShow: 3
      }
    }, {
      breakpoint: 776,
      settings: {
        slidesToShow: 2
      }
    }, {
      breakpoint: 500,
      settings: {
        slidesToShow: 1
      }
    }]
  });
});

$('#back-to-top').click(function () {
  $('html, body').animate({
    scrollTop: 0
  }, 'slow');
  return false;
});

// MODAL SESIÓN ***************************************************************
function inicioSesion() {
  let email = $('#inputEmailLogin').val();
  let contrasenna = $('#inputPasswordLogin').val();
  var data = {
    email: email,
    contrasenna: contrasenna
  };

  $.ajax({
    url: "php/recursos/verificar.php?action=cliente",
    type: "POST",
    dataType: "HTML",
    data: data,
    cache: false,

  }).done(function (echo) {
    if (echo !== "") {
      $("#response").html(echo);
    } else {
      // window.location.replace("");
      window.location.replace("");
    }
  });
}

function registrarse() {
  let email = $('#inputEmailRegister').val();
  let password = $('#inputPasswordRegister1').val();
  let password2 = $('#inputPasswordRegister2').val();

  if (password == password2) {
    var data = {
      email: email,
      password: password
    };

    $.ajax({
      url: "php/users/createUser.php?action=cliente",
      type: "POST",
      dataType: "HTML",
      data: data,
      cache: false,

    }).done(function (echo) {
      if (echo == "exito") {
        alert("Usuario creado con éxito");
        var data1 = {
          email: email,
          contrasenna: password
        };
      
        $.ajax({
          url: "php/recursos/verificar.php?action=cliente",
          type: "POST",
          dataType: "HTML",
          data: data1,
          cache: false,
      
        }).done(function (echo) {
          if (echo !== "") {
            $("#response").html(echo);
          } else {
            window.location.replace("");
          }
        });
      } else if (echo == "existe") {
        alert("Este usuario ya existe");
      } else {
        alert("Ha habido algún error, compruebe los datos y vuelva a intentarlo");
      }
    });
  } else {
    $("#response").text("Las contraseñas no son iguales");
  }
}

// FORMULARIO CONTACTO ********************************************************
function enviarFormulario() {
  let nombre = new String(document.getElementById("nombre").value);
  let email = new String(document.getElementById("email").value);
  let mensaje = new String(document.getElementById("mensaje").value);

  if (nombre.length != 0 && email.length != 0 && mensaje.length != 0) {
    if (!(/^\w+([-.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(email))) {
      if (confirm('¿Estas seguro de enviar este mensaje?')) {
        alert("Su mensaje se ha enviado con éxito");
        location.reload();
        return true;
      }
    }
  } else {
    alert("Faltan datos, compruebe el formulario");
    return false;
  }

}

// FORMULARIO CITA PREVIA ****************************************************
comprobarEnviar = function () {
  alert("Su solicitud se ha realizado correctamente");
  location.reload();
}

funcionReset = function () {
  if (confirm("Se borrarán todos los datos. ¿Está de acuerdo?")) {
    location.reload();
  }
}


// FUNCIONES PAGO ////////////////////////////////////////////////////
$('.input-cart-number').on('keyup change', function () {
  $t = $(this);

  if ($t.val().length > 3) {
    $t.next().focus();
  }

  var card_number = '';
  $('.input-cart-number').each(function () {
    card_number += $(this).val() + ' ';
    if ($(this).val().length == 4) {
      $(this).next().focus();
    }
  })

  if (screen.width > 999) {
    $('.number').html(card_number);
  }

});

$('#card-holder').on('keyup change', function () {
  $t = $(this);
  $('.credit-card-box .card-holder div').html($t.val());
});

$('#card-holder').on('keyup change', function () {
  $t = $(this);
  $('.credit-card-box .card-holder div').html($t.val());
});

$('#card-expiration-month, #card-expiration-year').change(function () {
  m = $('#card-expiration-month option').index($('#card-expiration-month option:selected'));
  m = (m < 10) ? '0' + m : m;
  y = $('#card-expiration-year').val().substr(2, 2);
  $('.card-expiration-date div').html(m + '/' + y);
})

$('#card-ccv').on('focus', function () {
  $('.credit-card-box').addClass('hover');
}).on('blur', function () {
  $('.credit-card-box').removeClass('hover');
}).on('keyup change', function () {
  $('.ccv div').html($(this).val());
});

$('#card-number').change(function () {
  console.log(getCreditCardType($(this).val()));
})


function precio() {
  var sitioPrecio = document.getElementById("precio");
  total = JSON.parse(localStorage.getItem("total"));
  if (total == null) {
    total = 0;
  }
  sitioPrecio.innerHTML = total + ' €';

  var boton = document.getElementById("boton");
  if (total == 0) {
    boton.disabled = true;
  }
}

function pagar() {
  let numTarjeta1 = new String(document.getElementById("card-number").value);
  let numTarjeta2 = new String(document.getElementById("card-number-1").value);
  let numTarjeta3 = new String(document.getElementById("card-number-2").value);
  let numTarjeta4 = new String(document.getElementById("card-number-3").value);
  let titular = new String(document.getElementById("card-holder").value);
  let mes = new String(document.getElementById("card-expiration-month").value);
  let anno = new String(document.getElementById("card-expiration-year").value);
  let ccv = new String(document.getElementById("card-ccv").value);



  if (numTarjeta1.length == 4 && numTarjeta2.length == 4 && numTarjeta3.length == 4 && numTarjeta4.length == 4) {
    if (titular.length != 0) {
      if (mes.length != 0 && anno.length != 0 && ccv.length == 3) {
        if (confirm('¿Confirmas esta compra?')) {
          alert("Compra realizada correctamente");
          window.open('../index.php');
          localStorage.removeItem('carrito');
          localStorage.removeItem('total');
          window.close();
        }
      }
    }

  } else {
    alert("Faltan datos, compruebe los campos");
  }
}