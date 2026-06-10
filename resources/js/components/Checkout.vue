<template>
        <section class="checkout-section py-5">
        <div class="container">
            <h2 class="mb-4 fw-bold">Checkout</h2>

            
                <div v-if="items.length === 0" class="alert alert-info">
                    Your cart is empty. <a href="/">Continue Shopping</a>
                </div>
            
            <div v-else  class="row g-4">
                <!-- Order Summary -->
                <div class="col-lg-7">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white fw-bold fs-5">Order Summary</div>
                        <div class="card-body p-0">
                            <table class="table mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Product</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-end">Amount</th>
                                        <th class="text-center">Remove</th>
                                    </tr>
                                </thead>
                                <tbody id="cart-items">
                                   
                                    <tr id="cart-row-{{ item.id }}" v-for="item in items" >
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <img :src="'/' + item.product.image"
                                                     :alt="item.product.name"
                                                     style="width:60px;height:60px;object-fit:cover;border-radius:8px;">
                                                <span>{{ item.product.name }}</span>
                                            </div>
                                        </td>
                                        <td class="text-center align-middle">{{ item.quantity }}</td>
                                        <td class="text-end align-middle">${{ item.amount }}</td>
                                        <td class="text-center align-middle">
                                            <button class="btn btn-sm btn-outline-danger remove-item"
                                                    data-id="{{ item.id }}"
                                                    data-amount="{{ item.amount }}"
                                                    @click="removeItem(item)">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot class="table-light">
                                    <tr>
                                        <td colspan="3" class="fw-bold text-end">Total</td>
                                        <td class="fw-bold text-end" id="cart-total">${{ cartTotal }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Billing Details -->
                <div class="col-lg-5">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white fw-bold fs-5">Billing Details</div>
                        <div class="card-body">
                            <form id="checkout-form" @submit.prevent="submitOrder"  method="POST">
                              
                                <div class="mb-3">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" name="name" class="form-control"  v-model="name" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" v-model="email"
                                            required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="phone" v-model="phone" class="form-control" placeholder="+1 234 567 890" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Address</label>
                                    <textarea name="address" v-model="address" class="form-control" rows="3"
                                              placeholder="Street, City, Country" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Payment Method</label>
                                    <select name="payment_method" v-model="payment"  id="payment-method" class="form-select">
                                        <option value="cod">Cash on Delivery</option>
                                        <option value="card">Credit / Debit Card (Stripe)</option>
                                    </select>
                                </div>

                                <!-- Stripe Card Element -->
                                <div v-if="payment ==='card'" id="stripe-section" class="mb-3">
                                    <label class="form-label">Card Details</label>
                                    <div id="card-element" class="form-control" style="height:42px;padding-top:10px;"></div>
                                    <div id="card-errors" class="text-danger small mt-1"></div>
                                </div>

                                <input type="hidden" name="stripe_token" id="stripe-token">

                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="fw-bold fs-5">Total: $<span id="billing-total">{{ total }}</span></span>
                                    <button type="submit" id="place-order-btn" class="btn btn-primary px-4">Place Order</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
</template>
<script>

export default {
    data(){
        return {
            items: [],
            name : '',
            email: '',
            address: '',
            phone : '',
            payment: 'cod',
            cardError : '',
            Stripe : null,
            cardElement : null,
            runningTotal : this.total
        }

    },
    props:{
        cartItems:{
            type:Array,
            required:true
        },
        total:{
            type:Number,
            required:true
        }      
    },
    computed:{
        cartTotal(){
            return this.items.reduce((sum,i)=>sum+Number(i.amount),0).toFixed(2);
        }
    },
    mounted() {
        this.items = [...this.cartItems];
        console.log(this.items);
    },
}
</script>
