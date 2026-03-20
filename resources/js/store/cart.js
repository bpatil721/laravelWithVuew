import axios from 'axios';
import {defineStore } from 'pinia';

export const useCartStore = defineStore('cart',{
     state:()=>({
        cart:[]
     }),
     actions:{
       async addToCart(data){
         alert('sdf');
            this.cart.push(data)
            await axios.post('/add-to-cart',{
               product_id : data.product.id,
               
               quantity : data.quantity
            })
        },
     }
})