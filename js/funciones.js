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
    url: "../admin/recursos/verificar.php?action=cliente",
    type: "POST",
    dataType: "HTML",
    data: data,
    cache: false,

  }).done(function (echo) {
    if (echo !== "") {
      $(".response").html(echo);
    } else {
      window.location.replace("");
    }
  });
}

function registrarse() {
  let email = $('#inputEmailRegister').val();
  let password = $('#inputPasswordRegister1').val();
  let password2 = $('#inputPasswordRegister2').val();

  if (password === password2) {
    var data = {
      email: email,
      password: password
    };

    $.ajax({
      url: "../admin/users/crearUsuario.php?action=cliente",
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
          url: "../admin/recursos/verificar.php?action=cliente",
          type: "POST",
          dataType: "HTML",
          data: data1,
          cache: false,

        }).done(function (echo) {
          if (echo !== "") {
            $(".response").html(echo);
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
    $(".response").text("Las contraseñas no son iguales");
  }
}

// FORMULARIO CONTACTO ********************************************************
function enviarFormulario(id_usuario) {
  $nombre = $('#inputName').val();
  $email = $('#inputMail').val();
  $telefono = $('#inputPhone').val();
  $asunto = $('#inputAsunto').val();
  $mensaje = $('#mensaje').val();

  if (id_usuario != "") {
    tipoUser = "cliente";
  } else {
    tipoUser = "visitante";
  }
  
  if (confirm('¿Quieres enviar este mensaje?')) {
    $.ajax({
      url: "../admin/messages/nuevoMensaje.php",
      type: "POST",
      dataType: "HTML",
      data: {
        id_usuario: id_usuario,
        tipoUser: tipoUser,
        nombre: $nombre,
        email: $email,
        telefono: $telefono,
        asunto: $asunto,
        mensaje: $mensaje
      },
      cache: false,
    }).done(function (echo) {
      if (echo == "exito") {
        alert("Mensaje enviado correctamente");
        window.location.replace("");
      } else if (echo == "existe") {
        alert("Este correo pertenece a un usuario registrado; por favor, inicie sesión e intentelo de nuevo");
      } else {
        alert("Ha habido algún error, compruebe los datos y vuelva a intentarlo");
      }
    });
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
  var total = JSON.parse(localStorage.getItem("total"));
  if (total == null) {
    total = 0;
  }
  sitioPrecio.innerHTML = total + ' €';

  var boton = document.getElementById("boton");
  if (total == 0) {
    boton.disabled = true;
  }

  var n = (new Date()).getFullYear()
  var select = document.getElementById("card-expiration-year");
  for (var i = n; i < n + 8; i++) select.options.add(new Option(i, i));
}

$("#pago").on("submit", function (e) {
  let numTarjeta1 = new String(document.getElementById("card-number").value);
  let numTarjeta2 = new String(document.getElementById("card-number-1").value);
  let numTarjeta3 = new String(document.getElementById("card-number-2").value);
  let numTarjeta4 = new String(document.getElementById("card-number-3").value);
  let titular = new String(document.getElementById("card-holder").value);
  let mes = new String(document.getElementById("card-expiration-month").value);
  let anno = new String(document.getElementById("card-expiration-year").value);
  let ccv = new String(document.getElementById("card-ccv").value);
  var unidades = JSON.parse(localStorage.getItem("carrito"));
  var jsonString = JSON.stringify(unidades);
  var precioTotal = localStorage.getItem("total");

  if (numTarjeta1.length == 4 && numTarjeta2.length == 4 && numTarjeta3.length == 4 && numTarjeta4.length == 4) {
    if (titular.length != 0) {
      if (mes.length != 0 && anno.length != 0 && ccv.length == 3) {
        if (confirm('¿Confirmas esta compra?')) {
          e.preventDefault();
          $.ajax({
            url: "../admin/sales/nuevoPedido.php",
            type: "POST",
            dataType: "HTML",
            data: {
              data: jsonString,
              total: precioTotal
            },
            cache: false,
          }).done(function (echo) {
            if (echo == 'exito') {
              alert("Su compra se ha realizado correctamente");
              localStorage.removeItem('carrito');
              localStorage.removeItem('total');
              window.location.replace("../index.php");
            } else {
              alert("Ha habido algún error, compruebe los datos y vuelva a intentarlo");
            }
          });
        }
      }
    }
  } else {
    alert("Faltan datos, compruebe los campos");
  }
})