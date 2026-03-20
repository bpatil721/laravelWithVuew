<template>
    <form @submit.prevent="updatePassword">
        <div class="mb-4">
            <label for="old-password" class="form-label">Current Password</label>
            <input 
                type="password" 
                id="old-password" 
                v-model="passwordForm.current_password" 
                class="form-control"
                :class="{ 'is-invalid': errors.current_password }"
            >
            <div v-if="errors.current_password" class="invalid-feedback">
                {{ errors.current_password[0] }}
            </div>
        </div>
        <div class="mb-4">
            <label for="new-password" class="form-label">New Password</label>
            <input 
                type="password" 
                id="new-password" 
                v-model="passwordForm.new_password" 
                class="form-control"
                :class="{ 'is-invalid': errors.new_password }"
            >
            <div v-if="errors.new_password" class="invalid-feedback">
                {{ errors.new_password[0] }}
            </div>
            <div class="form-text">Password must be at least 8 characters long.</div>
        </div>
        <div class="mb-4">
            <label for="confirm-password" class="form-label">Confirm Password</label>
            <input 
                type="password" 
                id="confirm-password" 
                v-model="passwordForm.new_password_confirmation" 
                class="form-control"
                :class="{ 'is-invalid': errors.new_password_confirmation }"
            >
            <div v-if="errors.new_password_confirmation" class="invalid-feedback">
                {{ errors.new_password_confirmation[0] }}
            </div>
        </div>
        <div class="mb-4">
            <button type="submit" class="btn btn-primary" :disabled="loading">
                <span v-if="loading" class="spinner-border spinner-border-sm me-2"></span>
                {{ loading ? 'Updating...' : 'Update Password' }}
            </button>
        </div>
    </form>
</template>
<script>
export default {
    data() {
        return {
            passwordForm: {
                current_password: '',
                new_password: '',
                new_password_confirmation: ''
            },
            errors: {},
            loading: false
        }
    },
    props: {
        user: {
            type: Object,
            required: false,
            default: null
        }
    },
    methods: {
        updatePassword() {
            this.errors = {};
            this.loading = true;
            this.$emit('update-password', this.passwordForm);
        },
        resetForm() {
            this.passwordForm = {
                current_password: '',
                new_password: '',
                new_password_confirmation: ''
            };
            this.errors = {};
            this.loading = false;
        }
    },
    watch: {
        // Watch for errors passed from parent
        '$attrs.errors': {
            handler(newErrors) {
                if (newErrors) {
                    this.errors = newErrors;
                    this.loading = false;
                }
            },
            deep: true
        }
    }
}
</script>
