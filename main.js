// Ejemplo de carga de productos en la tabla de "productos.html"
document.addEventListener("DOMContentLoaded", function(Heidysql2) {
    cargarProductos();
});

function cargarProductos() {
    // Simulación de productos cargados
    const productos = [
        { id: 1, nombre: "Vodka", precio: 100, stock: 20 },
        { id: 2, nombre: "Whisky", precio: 200, stock: 15 },
    ];
}
    const lista = document.getElementById("productos-lista");
    lista.innerHTML = "";
    productos.forEach(producto) 
        lista.innerHTML += `
            <tr>
                <td>${producto.id}</td>
                <td>${producto.nombre}</td>
                <td>$${producto.precio}</td>
                <td>${producto.stock}</td>  