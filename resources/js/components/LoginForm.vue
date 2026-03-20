<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Login</h1>
            </div>
            <form @submit.prevent="login">
                <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" v-model="email">
                        </div>
                </div>
                <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" v-model="password">
                        </div>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>

                <div class="col-md-6">
                    <input type="checkbox" id="remember" v-model="remember">
                    <label for="remember">Remember me</label>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    data() {
        return {
            'email': 't@t.com',
            'password': '123',
            'remember': false,
        }
    },
    methods: {
        getToast() {
            // Try multiple ways to get toast
            if (this.$toast) {
                return this.$toast;
            }
            // Try to get from app instance
            const app = this.$root?.$app || this.$root;
            if (app && app.$toast) {
                return app.$toast;
            }
            return null;
        },
        async  login(){
        try {
            const response = await axios.post('/post-login', {
                email: this.email,
                password: this.password,
                remember: this.remember
            });
            const toast = this.getToast();
            if (toast) {
                toast.success(response.data.message);
            } else {
                // Fallback if toast is not available
                alert(response.data.message);
            }
            if(response.data.status){
                window.location.href = '/user/dashboard';
            }
            } catch (error) {
                console.log(error);
                const toast = this.getToast();
                if (toast) {
                    const errorMessage = error.response?.data?.message || 'Login failed. Please check your credentials.';
                    toast.error(errorMessage);
                } else {
                    // Fallback if toast is not available
                    const errorMessage = error.response?.data?.message || 'Login failed. Please check your credentials.';
                    alert(errorMessage);
                }
            }
        }
    }
}
</script>