<x-frontend::frontend>
    <section class="product-detail py-5">
        <div id="app" data-component="SingleProduct" data-props='@json(["product" => $product])'></div>
    </section>

    <style>
        .product-detail {
            background-color: #f8f9fa;
        }
        
        .product-image-container {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
        }
        
        .product-image-container img {
            transition: transform 0.3s ease;
        }
        
        .product-image-container:hover img {
            transform: scale(1.05);
        }
        
        .product-title {
            color: #2c3e50;
        }
        
        .product-price h2 {
            font-size: 2.5rem;
        }
        
        .quantity-selector input[type="number"]::-webkit-inner-spin-button,
        .quantity-selector input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        
        .product-actions button {
            transition: all 0.3s ease;
        }
        
        .product-actions button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
    </style>

    <script src="{{ mix('js/app.js') }}"></script>
</x-frontend::frontend>
