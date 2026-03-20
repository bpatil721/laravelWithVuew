<template>
    <div class="container">
            <div class="row g-5">
                <!-- Product Image -->
                <div class="col-lg-6">
                    <div class="product-image-container">
                        <img :src="product.image" :alt="product.name" class="img-fluid rounded shadow">
                    </div>
                </div>

                <!-- Product Info -->
                <div class="col-lg-6">
                    <div class="product-info">
                        <!-- Category Badge -->
                        <div class="mb-3">
                            <span class="badge bg-secondary">{{ product.category?.name }}</span>
                        </div>

                        <!-- Product Name -->
                        <h1 class="product-title display-5 fw-bold mb-3">{{ product.name }}</h1>

                        <!-- Price -->
                        <div class="product-price mb-4">
                            <h2 class="text-primary fw-bold">${{ product.price }}</h2>
                        </div>

                        <!-- Description -->
                        <div class="product-description mb-4">
                            <h5 class="fw-bold mb-3">Description</h5>
                            <p class="text-muted">{{ product.description }}</p>
                        </div>

                        <!-- Quantity Selector -->
                        <div class="quantity-selector mb-4">
                            <h6 class="fw-bold mb-2">Quantity</h6>
                            <div class="input-group" style="max-width: 150px;">
                                <button class="btn btn-outline-secondary" type="button" id="decrease-qty" @click="decrease">-</button>
                                <input type="number" class="form-control text-center" v-model="qty" min="1" id="quantity">
                                <button class="btn btn-outline-secondary" type="button" id="increase-qty" @click="increase">+</button>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="product-actions d-flex gap-3 mb-4">
                            <button class="btn btn-primary btn-lg px-5" id="add-to-cart" @click="addToCart">
                                <i class="bi bi-cart-plus"></i> Add to Cart
                            </button>
                            <button class="btn btn-outline-danger btn-lg" id="add-to-wishlist">
                                <i class="bi bi-heart"></i>
                            </button>
                        </div>

                        <!-- Product Meta -->
                        <!-- <div class="product-meta border-top pt-4">
                            <div class="row g-3">
                                <div class="col-12">
                                    <strong>SKU:</strong> <span class="text-muted">PRD-{{ str_pad($product->id, 5, '0', STR_PAD_LEFT) }}</span>
                                </div>
                                <div class="col-12">
                                    <strong>Category:</strong> <span class="text-muted">{{ $product->category->name }}</span>
                                </div>
                                <div class="col-12">
                                    <strong>Availability:</strong> <span class="text-success">In Stock</span>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
import { useCartStore } from '../store/cart';
export default {
    name: 'SingleProduct',
    data() {
        return {
            qty: 1, 
        }
    },
    mounted() {
    
    },
    methods:{
       increase(){
            this.qty++;
       },
       decrease(){        
            if(this.qty>1){
                this.qty--;
            }
       },
       addToCart()
       {
            const cartStore = useCartStore();
            cartStore.addToCart({product: this.product, qty:this.qty});
       }
    },
    props: {
        product: {
            type: Object,
            required: false
        }
    }
}
</script>