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


    // Envío de los datos a la BD por AJAX formato json
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
    fetch(baseUrl+"api/new_product", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(product)
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        // Llama a la función para actualizar el listado en el <tbody>
        updateProductList(data.products);
    } else {
        console.error("Error al guardar el producto:", data.error);
    }
    })
    .catch(error => {
        console.error("Error al guardar el producto:", error);
    });
});

// //

function updateProductList(products) {
  // Selecciona el <tbody> donde se mostrarán los productos, asumiendo que tiene el id "productListTbody"
  const tbody = document.getElementById("products");
  
  // Limpia el contenido actual
  tbody.innerHTML = "";
  
  // Recorre cada producto para crear una fila de la tabla
  products.forEach(product => {
      // Crea la fila
      const row = document.createElement("tr");
      
      // Crea las celdas y asigna los valores correspondientes
      const tdName = document.createElement("td");
      tdName.textContent = product.name;
      row.appendChild(tdName);
      
      const tdDescription = document.createElement("td");
      tdDescription.textContent = product.description;
      row.appendChild(tdDescription);
      
      // Categoría (mostrando el nombre de la categoría)
      const tdCategory = document.createElement("td");
      tdCategory.textContent = product.category ? product.category.name : "";
      row.appendChild(tdCategory);
      
      // Proveedor (mostrando el nombre del proveedor)
      const tdProvider = document.createElement("td");
      tdProvider.textContent = product.provider ? product.provider.name : "";
      row.appendChild(tdProvider);
      
      const tdStock = document.createElement("td");
      tdStock.textContent = product.stock;
      row.appendChild(tdStock);

      const tdPrice = document.createElement("td");
      tdPrice.textContent = product.price;
      row.appendChild(tdPrice);

      // Celda para las acciones
      const tdActions = document.createElement("td");
      // Crea el enlace de "delete"
      const deleteLink = document.createElement("a");
      deleteLink.href = baseUrl + "product/delete/" + product.product_id;
      deleteLink.classList.add("btn", "btn-sm", "btn-danger");
      deleteLink.innerHTML = '<i class="fa-solid fa-trash"></i>';
      tdActions.appendChild(deleteLink);
      row.appendChild(tdActions);
      
      // Agrega la fila al <tbody>
      tbody.appendChild(row);
  });
}
