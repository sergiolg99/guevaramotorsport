$(document).ready(function () {
    cargarDatos();
});

var carrito = [];
var iva = 0.21;
var $carrito = document.querySelector('#carrito');
var $total = document.querySelector('#total');
var $iva = document.querySelector('#iva');

function cargarDatos() {
    $.ajax({
        dataType: "JSON",
        url: "../admin/products/getProductos.php",
    }).done(function (echo) {
        datos = echo;
        var $items = document.querySelector('#items');

        if ("carrito" in localStorage) {
            carrito = JSON.parse(localStorage.getItem("carrito"));
            calcularIva();
            calcularTotal();
            renderizarCarrito();
        }

        for (let producto of datos) {
            // Estructura
            let miNodo = document.createElement('div');
            miNodo.classList.add('card', 'col-sm-12', 'col-md-6', 'col-lg-4');
            // Body
            let miNodoCardBody = document.createElement('div');
            miNodoCardBody.classList.add('card-body');
            // Titulo
            let miNodoTitle = document.createElement('h5');
            miNodoTitle.classList.add('card-title');
            miNodoTitle.textContent = producto.nombre;
            // Imagen
            let miNodoImagen = document.createElement('img');
            miNodoImagen.classList.add('img-fluid', 'agrandar');
            miNodoImagen.setAttribute('src', '../admin/products/getImagen.php?id=' + producto.id_producto);
            // miNodoImagen.setAttribute('alt', info['alt']);
            miNodoImagen.setAttribute('data-toggle', "modal");
            miNodoImagen.setAttribute('data-target', "#infoProducto");
            miNodoImagen.setAttribute('marcador', producto.id_producto)
            miNodoImagen.addEventListener('click', cargarModal);
            let miNodoPrecio = document.createElement('p');
            miNodoPrecio.classList.add('card-text');
            miNodoPrecio.textContent = producto.precio + ' €';
            let miNodoStock = document.createElement('p');
            miNodoStock.classList.add('card-text');
            if (producto.stock == 0) {
                miNodoStock.textContent = "Agotado";
            } else {
                miNodoStock.textContent = "Unidades disponibles: " + producto.stock;
            }
            // Boton 
            let miNodoBoton = document.createElement('button');
            if (producto.stock == 0) {
                miNodoBoton.classList.add('btn', 'btn-primary', 'fas', 'fa-cart-plus', 'disabled');
                miNodoBoton.setAttribute('title', "Sin Stock");
            } else {
                miNodoBoton.classList.add('btn', 'btn-primary', 'fas', 'fa-cart-plus');
            }
            miNodoBoton.setAttribute('marcador', producto.id_producto);
            miNodoBoton.setAttribute('stock', producto.stock);
            miNodoBoton.addEventListener('click', anyadirCarrito);
            // Insertamos
            miNodoCardBody.appendChild(miNodoImagen);
            miNodoCardBody.appendChild(miNodoTitle);
            miNodoCardBody.appendChild(miNodoPrecio);
            miNodoCardBody.appendChild(miNodoStock);
            miNodoCardBody.appendChild(miNodoBoton);
            miNodo.appendChild(miNodoCardBody);
            $items.appendChild(miNodo);
        }
    });
}

function anyadirCarrito() {
    if (carrito == "") {
        // Anyadimos el Nodo a nuestro carrito
        carrito.push(this.getAttribute('marcador'));
        localStorage.setItem("carrito", JSON.stringify(carrito));
        // Calculo el total y el iva
        calcularIva();
        calcularTotal();
        // Renderizamos el carrito 
        renderizarCarrito();
        alert("Producto añadido al carrito");
    } else {
        renderizarCarrito();
        stock = this.getAttribute('stock');
        if (numeroUnidadesItem == stock) {
            alert("No disponemos de suficientes unidades");
            calcularIva();
            calcularTotal();
            renderizarCarrito();
        } else {
            // Anyadimos el Nodo a nuestro carrito
            carrito.push(this.getAttribute('marcador'));
            localStorage.setItem("carrito", JSON.stringify(carrito));
            // Calculo el total y el iva
            calcularIva();
            calcularTotal();
            // Renderizamos el carrito 
            renderizarCarrito();
            alert("Producto añadido al carrito");
        }
    }
}

function renderizarCarrito() {
    // Vaciamos todo el html
    $carrito.textContent = '';
    calcularTotal();
    // Quitamos los duplicados
    let carritoSinDuplicados = [...new Set(carrito)];
    // Generamos los Nodos a partir de carrito
    carritoSinDuplicados.forEach(function (item) {
        // Obtenemos el item que necesitamos de la base de datos
        let miItem = datos.filter(function (itemBaseDatos) {
            return itemBaseDatos.id_producto == item;
        });
        // Cuenta el número de veces que se repite el producto
        numeroUnidadesItem = carrito.reduce(function (total, itemId) {
            return itemId === item ? total += 1 : total;
        }, 0);
        // Creamos el nodo del item del carrito
        let miNodo = document.createElement('li');
        miNodo.classList.add('list-group-item', 'text-right', 'mx-2');
        miNodo.textContent = `${numeroUnidadesItem} x ${miItem[0]['nombre']} - ${miItem[0]['precio']} €`;
        // Boton de borrar
        let miBoton = document.createElement('button');
        miBoton.classList.add('btn', 'btn-danger', 'fas', 'fa-trash-alt');
        miBoton.style.marginLeft = '2rem';
        miBoton.setAttribute('item', item);
        miBoton.addEventListener('click', borrarItemCarrito);
        // Mezclamos nodos
        miNodo.appendChild(miBoton);
        $carrito.appendChild(miNodo);
    })
}

function borrarItemCarrito() {
    console.log()
    // Obtenemos el producto ID que hay en el boton pulsado
    let id = this.getAttribute('item');
    // Borramos todos los productos
    carrito = carrito.filter(function (carritoId) {
        return carritoId !== id;
    });
    localStorage.setItem("carrito", JSON.stringify(carrito));
    // volvemos a renderizar
    renderizarCarrito();
    // Calculamos de nuevo el precio y el iva
    calcularIva();
    calcularTotal();
}

function calcularIva() {
    totalIva = 0;
    // Recorremos el array del carrito
    for (let item of carrito) {
        // De cada elemento obtenemos su precio
        let miItem = datos.filter(function (itemBaseDatos) {
            return itemBaseDatos.id_producto == item;
        });
        totalIva = totalIva + (miItem[0]['precio']) * iva;
    }
    // Formateamos el total para que solo tenga dos decimales
    let ivaDosDecimales = totalIva.toFixed(2);
    // Renderizamos el precio en el HTML
    $iva.textContent = ivaDosDecimales;
}

function calcularTotal() {
    // Limpiamos precio anterior
    total = 0;
    total = parseInt(total);
    // Recorremos el array del carrito
    for (let item of carrito) {
        // De cada elemento obtenemos su precio
        let miItem = datos.filter(function (itemBaseDatos) {
            return itemBaseDatos.id_producto == item;
        });
        total = parseInt(total) + parseInt(miItem[0]['precio']);
        total = parseInt(total);
    }
    // Formateamos el total para que solo tenga dos decimales
    var totalDosDecimales = total.toFixed(2);
    // Renderizamos el precio en el HTML
    $total.textContent = totalDosDecimales;
    localStorage.setItem("total", JSON.stringify(total));
    var boton = document.getElementById("finalizarPedido");
    if (total == 0 || total == null) {
        boton.disabled = true;
    } else {
        boton.disabled = false;
    }
}

function cargarModal() {
    ver = [];
    ver.push(this.getAttribute('marcador'));

    let tituloModal = document.getElementById("modal-title");
    let descripcion = document.getElementById("modal-body");
    let footer = document.getElementById("modal-footer");

    tituloModal.textContent = '';
    descripcion.textContent = '';
    footer.textContent = '';

    let itemModal = new Set(ver);
    let titulo = document.createElement('h4');
    let cuerpo = document.createElement('div');
    let botonComprar = document.createElement('button');
    itemModal.forEach(function (item) {
        let miItem = datos.filter(function (itemBaseDatos) {
            return itemBaseDatos.id_producto == item;
        });
        titulo.classList.add('modal-title');
        titulo.textContent = miItem[0]['nombre'];
        cuerpo.classList.add('row');
        var lugarImagen = document.createElement('div');
        lugarImagen.classList.add('col-xs-12', 'col-sm-12', 'col-md-6', 'col-lg-6');
        let imagen = document.createElement('img');
        imagen.classList.add('img-fluid', 'noHover');
        imagen.setAttribute('src', '../admin/products/getImagen.php?id=' + miItem[0]['id_producto']);
        lugarImagen.appendChild(imagen);
        var detalles = document.createElement('div');
        detalles.classList.add('col-xs-12', 'col-sm-12', 'col-md-6', 'col-lg-6');
        let tituloDetalles = document.createElement('h5');
        tituloDetalles.classList.add('card-text');
        tituloDetalles.textContent = 'Detalles';
        detalles.appendChild(tituloDetalles);
        let texto = document.createElement('p');
        texto.classList.add('card-text');
        texto.innerText = miItem[0]['descripcion'];
        detalles.appendChild(texto);
        let stock = document.createElement('p');
        stock.classList.add('card-text');
        if (miItem[0]['stock'] == 0) {
            stock.textContent = "Agotado";
        } else {
            stock.textContent = "Unidades disponibles: " + miItem[0]['stock'];
        }
        detalles.appendChild(stock);
        let precio = document.createElement('p');
        precio.classList.add('card-text');
        precio.textContent = "Precio: " + miItem[0]['precio'] + " €";
        detalles.appendChild(precio);
        cuerpo.appendChild(lugarImagen);
        cuerpo.appendChild(detalles);
        botonComprar.textContent = "Añadir al carrito";
        if (miItem[0]['stock'] == 0) {
            botonComprar.classList.add('btn', 'btn-primary', 'disabled');
        } else {
            botonComprar.classList.add('btn', 'btn-primary');
        }
        botonComprar.setAttribute('marcador', miItem[0]['id_producto']);
        botonComprar.setAttribute('stock', miItem[0]['stock']);
        botonComprar.setAttribute('data-dismiss', 'modal');
        botonComprar.addEventListener('click', anyadirCarrito);
    })
    
    tituloModal.appendChild(titulo);
    descripcion.appendChild(cuerpo);
    footer.appendChild(botonComprar);
}