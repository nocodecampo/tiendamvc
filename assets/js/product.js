const protocol = window.location.protocol; // "http:" o "https:"
const host = window.location.host;         // "localhost:3000" o "www.ejemplo.com"
const baseUrl = protocol + '//' + host + '/tiendamvc-1/';

  // Cargamos categorías
fetch(baseUrl+"api/categories")
.then(response => response.json())
  .then(data => {
    // Suponemos que data es un array de objetos, por ejemplo:
    // [{ category_id: 1, name: "Categoría 1" }, { category_id: 2, name: "Categoría 2" }]
    const selectElement = document.getElementById('category');
    data.forEach(category => {
      const option = document.createElement('option');
      option.value = category.category_id; 
      option.textContent = category.name; 
      selectElement.appendChild(option);
    });
  })
  .catch(error => console.error('Error al obtener las categorías:', error));

  // Cargamos proveedores
  fetch(baseUrl+"api/providers")
    .then(response => response.json())
    .then(data => {
        const selectElement = document.getElementById('provider');
        data.forEach(provider => {
        const option = document.createElement('option');
        option.value = provider.provider_id; 
        option.textContent = provider.name; 
        selectElement.appendChild(option);
        });
    })
    .catch(error => console.error('Error al obtener los proveedores:', error));


    // -- //
   const formulario = document.getElementById("form");

   formulario.addEventListener("submit", function(e){
    e.preventDefault();
    let product = {
        'name': document.getElementById("name").value,
        'description': document.getElementById("description").value,
        'category': document.getElementById("category").value,
        'provider': document.getElementById("provider").value,
        'stock': document.getElementById("stock").value,
        'price': document.getElementById("price").value
    };


    // Envío de datos vía Ajax (fetch)
    fetch(baseUrl+"api/product", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(product)
    })
    .then(response => response.json())
    .then(data => {
        console.log("Producto guardado:", data);
        // Aquí puedes redirigir o mostrar un mensaje de éxito
    })
    .catch(error => {
        console.error("Error al guardar el producto:", error);
    });
});