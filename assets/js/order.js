document.getElementById("addProductBtn").addEventListener("click", function() {
    // Obtener el contenedor de productos
    const container = document.getElementById("productsContainer");
    // Contar cuántas filas existen actualmente
    const index = container.querySelectorAll('.productRow').length;
    // Clonar la primera fila de producto
    const newRow = container.querySelector('.productRow').cloneNode(true);

    // Actualizar los nombres de los campos para que sean únicos y vaciar los valores
    newRow.querySelectorAll('select, input').forEach(function(input) {
        let name = input.getAttribute('name');
        // Reemplazar el índice existente por el nuevo índice
        name = name.replace(/\[\d+\]/, '[' + index + ']');
        input.setAttribute('name', name);
        input.value = "";
    });

    container.appendChild(newRow);
});

// Delegación de eventos para eliminar una fila de producto
document.getElementById("productsContainer").addEventListener("click", function(e) {
    if (e.target.closest(".removeProductBtn")) {
        const container = document.getElementById("productsContainer");
        const productRows = container.querySelectorAll(".productRow");
        // Si hay más de una fila, se puede eliminar
        if (productRows.length > 1) {
            const row = e.target.closest(".productRow");
            row.remove();
        } else {
            alert("Al menos un producto es obligatorio.");
        }
    }
});

// Precio
document.getElementById("productsContainer").addEventListener("change", function(e) {
    if (e.target && e.target.matches(".product-select")) {
        // Obtener el precio del option seleccionado
        var price = e.target.options[e.target.selectedIndex].getAttribute("data-price");
        // Buscar la fila (row) que contiene este select
        var row = e.target.closest(".productRow");
        if (row) {
            var priceInput = row.querySelector(".product-price");
            if (priceInput) {
                priceInput.value = price ? price : "";
            }
        }
    }
});

// Validacion duplicados
document.getElementById("productsContainer").addEventListener("change", function(e) {
    if (e.target && e.target.matches(".product-select")) {
        // Obtén el producto seleccionado en el select que disparó el evento
        const selectedProductId = e.target.value;

        // Recorrer todos los selects de producto para verificar duplicados
        const allSelects = document.querySelectorAll(".product-select");
        let duplicateCount = 0;
        allSelects.forEach(function(select) {
            if (select.value === selectedProductId && selectedProductId !== "") {
                duplicateCount++;
            }
        });

        // Si hay más de uno, mostrar alerta y limpiar el select duplicado
        if (duplicateCount > 1) {
            alert("Este producto ya ha sido agregado. Por favor, selecciona otro producto o modifica la cantidad.");
            // Reiniciar el select que disparó el evento
            e.target.value = "";
            // También podrías enfocar el select para que el usuario elija nuevamente
            e.target.focus();
        }
    }
});