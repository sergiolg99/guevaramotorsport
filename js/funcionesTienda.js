//JAVASCRIPT A EJECUTARSE UNA VEZ CARGADA LA PAGINA DE CARRITO:

// Variables
var baseDeDatos = [{
        id: 1,
        nombre: 'Maletas',
        precio: 220,
        imagen: 'imagenes/productos/maletas.jpg',
        descripcion: 'Maletas rígidas universales con capacidad para 1 casco integral.',
        alt: 'Maletas de moto'
    },
    {
        id: 2,
        nombre: 'Soporte Maletas',
        precio: 70,
        imagen: 'imagenes/productos/soporte.jpg',
        descripcion: 'Soporte universal para maletas laterales rígidas.',
        alt: 'Soporte para maletas'
    },
    {
        id: 3,
        nombre: 'Puños calefactables',
        precio: 65,
        imagen: 'imagenes/productos/puños.jpg',
        descripcion: '4 niveles de potencia regulable desde el manillar.',
        alt: 'Puños calefactables universales'
    },
    {
        id: 4,
        nombre: 'Funda Moto',
        precio: 25,
        imagen: 'imagenes/productos/funda.jpg',
        descripcion: 'Perfecta para todas las estaciones. Mantén tu moto resguardada del polvo, del frío y del sol.',
        alt: 'Funda de moto negra'
    },
    {
        id: 5,
        nombre: 'Pernera',
        precio: 15,
        imagen: 'imagenes/productos/pernera.jpg',
        descripcion: 'Comoda pernera para llevar en tus salidas moteras y poder cargar con tus enseres personales.',
        alt: 'Pernera para el motorista'
    },
    {
        id: 6,
        nombre: 'Guantes de Verano',
        precio: 59,
        imagen: 'imagenes/productos/gVerano.jpg',
        descripcion: 'Perfectos guantes de moto para cuando el calor aprieta sin renunciar a la seguridad y comodidad.',
        alt: 'Guantes de moto de verano'
    },
    {
        id: 7,
        nombre: 'Guantes de Invierno',
        precio: 129,
        imagen: 'imagenes/productos/gInvierno.jpg',
        descripcion: 'Perfectos guantes para no pasar frio en invierno sin renunciar a la seguridad.',
        alt: 'Guantes de moto de invierno'
    },
    {
        id: 8,
        nombre: 'Sotocasco',
        precio: 12,
        imagen: 'imagenes/productos/sotocasco.jpg',
        descripcion: 'Cómodo sotocasco para todo el año. Evita un exceso de humdedad y frio dentro del casco.',
        alt: 'Sotocasco negro'
    },
    {
        id: 9,
        nombre: 'Candado antirobo',
        precio: 19,
        imagen: 'imagenes/productos/candado.jpg',
        descripcion: 'Candado de la mas alta calidad para evitar el robo de nuestras motos.',
        alt: 'Candado antirrobo para moto'
    }
]

let $items = document.querySelector('#items');
let carrito = [];
let total = 0;
let iva = 0.21;
let $carrito = document.querySelector('#carrito');
let $total = document.querySelector('#total');
let $iva = document.querySelector('#iva');

// Funciones
function renderItems() {
    if ("carrito" in localStorage) {
        carrito = JSON.parse(localStorage.getItem("carrito"));
        calcularIva();
        calcularTotal();
        renderizarCarrito();
    }
    for (let info of baseDeDatos) {
        // Estructura
        let miNodo = document.createElement('div');
        miNodo.classList.add('card', 'col-sm-12', 'col-md-6', 'col-lg-4');
        // Body
        let miNodoCardBody = document.createElement('div');
        miNodoCardBody.classList.add('card-body');
        // Titulo
        let miNodoTitle = document.createElement('h5');
        miNodoTitle.classList.add('card-title');
        miNodoTitle.textContent = info['nombre'];
        // Imagen
        let miNodoImagen = document.createElement('img');
        miNodoImagen.classList.add('img-fluid', 'agrandar');
        miNodoImagen.setAttribute('src', info['imagen']);
        miNodoImagen.setAttribute('alt', info['alt']);
        miNodoImagen.setAttribute('data-toggle', "modal");
        miNodoImagen.setAttribute('data-target', "#infoProducto");
        miNodoImagen.setAttribute('marcador', info['id'])
        miNodoImagen.addEventListener('click', cargarModal);
        let miNodoPrecio = document.createElement('p');
        miNodoPrecio.classList.add('card-text');
        miNodoPrecio.textContent = info['precio'] + '€';
        // Boton 
        let miNodoBoton = document.createElement('button');
        miNodoBoton.classList.add('btn', 'btn-primary', 'fas', 'fa-cart-plus');
        miNodoBoton.setAttribute('marcador', info['id']);
        miNodoBoton.addEventListener('click', anyadirCarrito);
        // Insertamos
        miNodoCardBody.appendChild(miNodoImagen);
        miNodoCardBody.appendChild(miNodoTitle);
        miNodoCardBody.appendChild(miNodoPrecio);
        miNodoCardBody.appendChild(miNodoBoton);
        miNodo.appendChild(miNodoCardBody);
        $items.appendChild(miNodo);
    }
}

function anyadirCarrito() {
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

function renderizarCarrito() {
    // Vaciamos todo el html
    $carrito.textContent = '';
    // Quitamos los duplicados
    let carritoSinDuplicados = [...new Set(carrito)];
    // Generamos los Nodos a partir de carrito
    carritoSinDuplicados.forEach(function (item, indice) {
        // Obtenemos el item que necesitamos de la variable base de datos
        let miItem = baseDeDatos.filter(function (itemBaseDatos) {
            return itemBaseDatos['id'] == item;
        });
        // Cuenta el número de veces que se repite el producto
        let numeroUnidadesItem = carrito.reduce(function (total, itemId) {
            return itemId === item ? total += 1 : total;
        }, 0);
        // Creamos el nodo del item del carrito
        let miNodo = document.createElement('li');
        miNodo.classList.add('list-group-item', 'text-right', 'mx-2');
        miNodo.textContent = `${numeroUnidadesItem} x ${miItem[0]['nombre']} - ${miItem[0]['precio']}€`;
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
        let miItem = baseDeDatos.filter(function (itemBaseDatos) {
            return itemBaseDatos['id'] == item;
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
    // Recorremos el array del carrito
    for (let item of carrito) {
        // De cada elemento obtenemos su precio
        let miItem = baseDeDatos.filter(function (itemBaseDatos) {
            return itemBaseDatos['id'] == item;
        });
        total = total + miItem[0]['precio'];
    }
    // Formateamos el total para que solo tenga dos decimales
    let totalDosDecimales = total.toFixed(2);
    // Renderizamos el precio en el HTML
    $total.textContent = totalDosDecimales;
    localStorage.setItem("total", JSON.stringify(total));
    var boton = document.getElementById("finalizarPedido");
    if (total == 0 || total == null) {
        boton.disabled = true;
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
        let miItem = baseDeDatos.filter(function (itemBaseDatos) {
            return itemBaseDatos['id'] == item;
        });
        titulo.classList.add('modal-title');
        titulo.textContent = miItem[0]['nombre'];
        cuerpo.classList.add('row');
        var lugarImagen = document.createElement('div');
        lugarImagen.classList.add('col-xs-12', 'col-sm-12', 'col-md-6', 'col-lg-6');
        let imagen = document.createElement('img');
        imagen.classList.add('img-fluid', 'noHover');
        imagen.setAttribute('src', miItem[0]['imagen']);
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
        let precio = document.createElement('p');
        precio.classList.add('card-text');
        precio.textContent = "Precio: " + miItem[0]['precio'] + " €";
        detalles.appendChild(precio);
        cuerpo.appendChild(lugarImagen);
        cuerpo.appendChild(detalles);
        botonComprar.textContent = "Añadir al carrito";
        botonComprar.classList.add('btn', 'btn-primary');
        botonComprar.setAttribute('marcador', miItem[0]['id']);
        botonComprar.setAttribute('data-dismiss', 'modal');
        botonComprar.addEventListener('click', anyadirCarrito);
    })

    tituloModal.appendChild(titulo);
    descripcion.appendChild(cuerpo);
    footer.appendChild(botonComprar);
}

// Inicio
renderItems();