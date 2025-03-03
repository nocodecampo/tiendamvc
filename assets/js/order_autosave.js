function saveOrderData() {
    const orderData = {
        customer_id: document.querySelector('[name="customer_id"]').value,
        discount: document.querySelector('[name="discount"]').value,
        products: []
    };

    // Get all product rows
    const productRows = document.querySelectorAll('.productRow');
    productRows.forEach((row, index) => {
        orderData.products.push({
            product_id: row.querySelector('[name^="products"][name$="[product_id]"]').value,
            quantity: row.querySelector('[name^="products"][name$="[quantity]"]').value,
            price: row.querySelector('[name^="products"][name$="[price]"]').value
        });
    });

    localStorage.setItem('orderDraft', JSON.stringify(orderData));
}

function loadOrderData() {
    const savedData = localStorage.getItem('orderDraft');
    if (!savedData) return;

    const orderData = JSON.parse(savedData);

    // Restore customer and discount
    document.querySelector('[name="customer_id"]').value = orderData.customer_id;
    document.querySelector('[name="discount"]').value = orderData.discount;

    // Remove all existing product rows except the first one
    const container = document.getElementById('productsContainer');
    const firstRow = container.querySelector('.productRow');
    container.innerHTML = '';
    container.appendChild(firstRow);

    // Restore products
    orderData.products.forEach((product, index) => {
        if (index === 0) {
            // Update first row
            updateProductRow(firstRow, product);
        } else {
            // Add new rows for additional products
            document.getElementById('addProductBtn').click();
            const newRow = container.querySelector('.productRow:last-child');
            updateProductRow(newRow, product);
        }
    });
}

function updateProductRow(row, productData) {
    row.querySelector('[name^="products"][name$="[product_id]"]').value = productData.product_id;
    row.querySelector('[name^="products"][name$="[quantity]"]').value = productData.quantity;
    row.querySelector('[name^="products"][name$="[price]"]').value = productData.price;
}

// Auto-save when changes are made
document.addEventListener('input', function(e) {
    if (e.target.closest('#productsContainer') || 
        e.target.name === 'customer_id' || 
        e.target.name === 'discount') {
        saveOrderData();
    }
});

// Clear saved data when form is submitted
document.querySelector('form').addEventListener('submit', function() {
    localStorage.removeItem('orderDraft');
});

// Load saved data when page loads
document.addEventListener('DOMContentLoaded', loadOrderData);
