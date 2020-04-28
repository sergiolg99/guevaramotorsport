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
                    window.open('../index.html');
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