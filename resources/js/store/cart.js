import axios from 'axios';
import { defineStore } from 'pinia';
import { useToast } from 'vue-toastification';

export const useCartStore = defineStore('cart', {
    state: () => ({
        cart: []
    }),
    actions: {
        async addToCart(data) {
            const toast = useToast();
            try {
               let qty = data.qty || 1;
                await axios.post('/carts', {
                    product_id: data.product.id,
                    quantity : qty ,
                    amount: data.amount * qty
                });
                this.cart.push(data);
                toast.success('Product added to cart!');
                window.location.href = '/checkout';
            } catch (error) {
                if (error.response?.status === 401) {
                    toast.error('You are not logged in. Please login first.');
                } else {
                  console.log(error)
                    toast.error('Something went wrong. Please try again.');
                }
            }
        },
    }
})
