<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .product-card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 16px;
            margin: 10px;
            width: 300px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .product-card:hover {
            transform: scale(1.05);
        }

        .product-title {
            font-size: 1.2em;
            font-weight: bold;
        }

        .product-attribute {
            font-size: 0.9em;
            color: #555;
        }

        .product-description {
            margin-top: 10px;
            font-size: 0.95em;
            color: #333;
        }

        .product-stock {
            font-size: 0.95em;
            color: green;
        }

        .product-list {
            display: flex;
            flex-wrap: wrap;
        }
    </style>
    <title>Product List</title>
</head>

<body>
    <div id="product-list" class="product-list"></div>

    <script>
        function fetchProducts() {
            fetch('/api/products')
                .then(response => response.json())
                .then(responseData => {
                    console.log(responseData);
                    const products = responseData.data;
                    const productList = document.getElementById('product-list');
                    productList.innerHTML = '';

                    products.forEach(product => {
                        const productCard = document.createElement('div');
                        productCard.classList.add('product-card');

                        productCard.innerHTML = `
                            <div class="product-title">${product.name}</div>
                            <div class="product-attribute">Attribute: ${product.attribute_name} - ${product.attribute_value}</div>
                            <div class="product-description">${product.description}</div>
                            <div class="product-stock">Stock: ${product.stock}</div>
                            <div class="product-variant">Variant: ${product.variant}</div>
                            <div class="product-state">State: ${product.state === 1 ? 'Available' : 'Unavailable'}</div>
                        `;

                        productList.appendChild(productCard);
                    });
                })
                .catch(error => console.error('Error fetching products:', error));
        }

        fetchProducts();
    </script>
</body>

</html>