<template>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-3">
                <!-- Left Sidebar - Vertical Tabs -->
                <div class="card shadow-sm">
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column" id="profileTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link w-100 text-start px-4 py-3" 
                                        :class="{ active: activeTab === 'profile' }"
                                        @click="activeTab = 'profile'"
                                        type="button">
                                    <i class="bi bi-person-circle me-2"></i> Profile Settings
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link w-100 text-start px-4 py-3" 
                                        :class="{ active: activeTab === 'password' }"
                                        @click="activeTab = 'password'"
                                        type="button">
                                    <i class="bi bi-key me-2"></i> Change Password
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-md-9">
                <!-- Profile Settings Tab -->
                <div v-if="activeTab === 'profile'" class="card shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h4 class="mb-0">Profile Settings</h4>
                        <p class="text-muted small mb-0">Update your profile information</p>
                    </div>
                    <div class="card-body">
                        <!-- <ProfileForm v-if="user" :user="user" @update-profile="updateProfile" /> -->
                       <form @submit.prevent="updateProfile" enctype="multipart/form-data">
                            <div class="mb-4 text-center">
                                <img :src="profileImagePreview" alt="profile image" class="rounded-circle" style="width: 100px; height: 100px;">
                            </div>
                            <div class="mb-4">
                                <label for="name" class="form-label">Name</label>
                                <input type='text' 
                                       id="name"
                                       v-model='form.name' 
                                       class='form-control'
                                       :class="{ 'is-invalid': errors.name }"
                                       required>
                                <div v-if="errors.name" class="invalid-feedback">{{ errors.name[0] }}</div>
                            </div>
                            <div class="mb-4">
                                <label for="email" class="form-label">Email</label>
                                <input type='email' 
                                       id="email"
                                       v-model='form.email' 
                                       class='form-control'
                                       :class="{ 'is-invalid': errors.email }"
                                       required>
                                <div v-if="errors.email" class="invalid-feedback">{{ errors.email[0] }}</div>
                            </div>
                            <div class="mb-4">
                                <label for="profile_image" class="form-label">Profile Image</label>
                                <input type='file' 
                                       id="profile_image"
                                       @change='handleProfileImageChange'  
                                       class='form-control'
                                       accept="image/*">
                            </div>
                            <button type='submit' class='btn btn-primary'>Update Profile</button>
                        </form>
                    </div>
                </div>;
                
                <!-- Change Password Tab -->
                <div v-if="activeTab === 'password'" class="card shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h4 class="mb-0">Change Password</h4>
                        <p class="text-muted small mb-0">Update your password to keep your account secure</p>
                    </div>
                    <div class="card-body">
                        <ChangePassword  
                            v-if="user" 
                            :user="user" 
                            @update-password='updatePassword'
                            ref="changePasswordComponent" />
                       <!--  <form @submit.prevent="updatePassword">
                         
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Current Password</label>
                                <input type="password" 
                                       class="form-control" 
                                       :class="{ 'is-invalid': errors.current_password }"
                                       id="current_password" 
                                       v-model="passwordForm.current_password" 
                                       >
                                <div v-if="errors.current_password" class="invalid-feedback">{{ errors.current_password[0] }}</div>
                            </div>
                            
                            
                            <div class="mb-3">
                                <label for="new_password" class="form-label">New Password</label>
                                <input type="password" 
                                       class="form-control" 
                                       :class="{ 'is-invalid': errors.new_password }"
                                       id="new_password" 
                                       v-model="passwordForm.new_password" 
                                       >
                                <div v-if="errors.new_password" class="invalid-feedback">{{ errors.new_password[0] }}</div>
                                <div class="form-text">Password must be at least 8 characters long.</div>
                            </div>
                            
                            
                            <div class="mb-3">
                                <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                                <input type="password" 
                                       class="form-control" 
                                       id="new_password_confirmation" 
                                       v-model="passwordForm.new_password_confirmation" 
                                       >
                            </div>
                            
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" class="btn btn-primary px-4" :disabled="passwordLoading">
                                    <span v-if="passwordLoading" class="spinner-border spinner-border-sm me-2"></span>
                                    <i v-else class="bi bi-key me-2"></i>{{ passwordLoading ? 'Updating...' : 'Update Password' }}
                                </button>
                            </div>
                        </form> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
// import ProfileForm from './ProfileForm.vue'
import ChangePassword from './ChangePassword.vue'

import { useToast } from "vue-toastification";
export default {
    components: {
        ChangePassword
    },
    data() {
        return {
            activeTab: 'profile',
            loading: false,
            passwordLoading: false,
            form: {
                name: '',
                email: '',
                profile_image: null
            },
            passwordForm: {
                current_password: '',
                new_password: '',
                new_password_confirmation: ''
            },
            errors: {},
            profileImagePreview: '',
            user: null
        }
    },
    
    mounted() {
        this.fetchUserProfile();
    },
    
    methods: {
        async fetchUserProfile() {
            try {
                const response = await axios.get('/user/profile');
                this.user = response.data.user;
                this.form.name = response.data.user.name;
                this.form.email = response.data.user.email;
                
                // Set profile image preview
                if (response.data.user.profile_image) {
                    if (response.data.user.profile_image.startsWith('data:image')) {
                        this.profileImagePreview = response.data.user.profile_image;
                    } else {
                        this.profileImagePreview = `/storage/${response.data.user.profile_image}`;
                    }
                } else {
                    this.profileImagePreview = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTIwIiBoZWlnaHQ9IjEyMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48Y2lyY2xlIGN4PSI2MCIgY3k9IjYwIiByPSI2MCIgZmlsbD0iI2NjYyIvPjx0ZXh0IHg9IjUwJSIgeT0iNTAlIiBmb250LXNpemU9IjQwIiBmaWxsPSIjOTk5IiB0ZXh0LWFuY2hvcj0ibWlkZGxlIiBkeT0iLjNlbSI+QTzwL3RleHQ+PC9zdmc+';
                }
            } catch (error) {
                console.error('Failed to fetch user profile:', error);
                this.$toast.error('Failed to load profile information');
            }
        },
        
        handleProfileImageChange(event) {
            const file = event.target.files[0];
            if (file) {
                this.form.profile_image = file;
                
                // Preview image
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.profileImagePreview = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        },
    // using emit 
      // async updateProfile(data) {
      async updateProfile() {
            const toast = useToast();
            this.loading = true;
            this.errors = {};
            try{
                const formData =  new FormData();
                // formData.append('name', data.name);
                // formData.append('email', data.email);
                formData.append('name', this.form.name);
                formData.append('email', this.form.email);

                 formData.append('_method', 'PUT');
                // if(data.profile_image){
                //     formData.append('profile_image', data.profile_image);
                // }
                if (this.form.profile_image) {
                    formData.append('profile_image', this.form.profile_image);
                }
                const response = await axios.post('/user/profile',formData);
                //  this.user = response.data.user;
                toast.success(
                        response.data.message || 'Profile updated successfully! ✅'
                    );
            }catch(error){
                console.log(error);
                if(error.response && error.response.status === 422){
                      toast.error(error.response?.data?.message || 'Failed to update profile ❌');
                }else{
                  toast.error(error.response?.data?.message || 'Failed to update profile ❌');
                }
            }finally{
                this.loading = false;
            }
        },
        
        // async updateProfile() {
        //     this.loading = true;
        //     this.errors = {};
            
        //     try {
        //         const formData = new FormData();
        //         formData.append('name', this.form.name);
        //         formData.append('email', this.form.email);
        //         formData.append('_method', 'PUT');
                
        //         if (this.form.profile_image) {
        //             formData.append('profile_image', this.form.profile_image);
        //         }
                
        //         const response = await axios.post('/user/profile', formData, {
        //             headers: {
        //                 'Content-Type': 'multipart/form-data'
        //             }
        //         });
                
        //         this.$toast.success(response.data.message || 'Profile updated successfully! ✅');
                
        //         // Update user data
        //         if (response.data.user) {
        //             this.user = response.data.user;
        //             this.form.name = response.data.user.name;
        //             this.form.email = response.data.user.email;
                    
        //             if (response.data.user.profile_image) {
        //                 if (response.data.user.profile_image.startsWith('data:image')) {
        //                     this.profileImagePreview = response.data.user.profile_image;
        //                 } else {
        //                     this.profileImagePreview = `/storage/${response.data.user.profile_image}`;
        //                 }
        //             }
        //         }
                
        //         // Clear file input
        //         this.form.profile_image = null;
        //         document.getElementById('profile_image').value = '';
                
        //     } catch (error) {
        //         if (error.response && error.response.status === 422) {
        //             this.errors = error.response.data.errors || {};
                    
        //             // Show validation errors in toast
        //             let errorMessages = [];
        //             Object.keys(this.errors).forEach(key => {
        //                 errorMessages.push(this.errors[key][0]);
        //             });
        //             const errorText = errorMessages.join('\n');
        //             this.$toast.error(errorText, { timeout: 5000 });
        //         } else {
        //             const errorMessage = error.response?.data?.message || 'Failed to update profile ❌';
        //             this.$toast.error(errorMessage);
        //         }
        //     } finally {
        //         this.loading = false;
        //     }
        // },
        
        // async updatePassword() {
        //     this.passwordLoading = true;
        //     this.errors = {};
            
        //     try {
        //         const response = await axios.put('/user/profile/password', {
        //             current_password: this.passwordForm.current_password,
        //             new_password: this.passwordForm.new_password,
        //             new_password_confirmation: this.passwordForm.new_password_confirmation
        //         });
                
        //         this.$toast.success(response.data.message || 'Password updated successfully! ✅');
                
        //         // Clear form
        //         this.passwordForm = {
        //             current_password: '',
        //             new_password: '',
        //             new_password_confirmation: ''
        //         };
                
        //     } catch (error) {
        //         if (error.response && error.response.status === 422) {
        //             this.errors = error.response.data.errors || {};
                    
        //             // Show validation errors in toast
        //             let errorMessages = [];
        //             Object.keys(this.errors).forEach(key => {
        //                 errorMessages.push(this.errors[key][0]);
        //             });
        //             const errorText = errorMessages.join('\n');
        //             this.$toast.error(errorText, { timeout: 5000 });
        //         } else {
        //             const errorMessage = error.response?.data?.message || 'Failed to update password ❌';
        //             this.$toast.error(errorMessage);
        //         }
        //     } finally {
        //         this.passwordLoading = false;
        //     }
        // }
        async updatePassword(data) {
            const toast = useToast();
            this.passwordLoading = true;
            this.errors = {};
            
            try {
                // Validate passwords match
                if (data.new_password !== data.new_password_confirmation) {
                    toast.error('New password and confirm password must match');
                    this.passwordLoading = false;
                    return;
                }
                
                const response = await axios.post('/user/change-password', {
                    current_password: data.current_password,
                    new_password: data.new_password,
                    new_password_confirmation: data.new_password_confirmation
                });
                
                if (response.data.message) {
                    toast.success(response.data.message || 'Password updated successfully! ✅');
                }
                
                // Clear form
                this.passwordForm = {
                    current_password: '',
                    new_password: '',
                    new_password_confirmation: ''
                };
                
                // Reset child component form
                if (this.$refs.changePasswordComponent) {
                    this.$refs.changePasswordComponent.resetForm();
                }
                
            } catch (error) {
                console.error('Password update error:', error);
                
                if (error.response && error.response.status === 422) {
                    this.errors = error.response.data.errors || {};
                    
                    // Pass errors to child component if needed
                    if (this.$refs.changePasswordComponent && error.response.data.errors) {
                        this.$refs.changePasswordComponent.errors = error.response.data.errors;
                    }
                    
                    // Show validation errors
                    if (error.response.data.errors) {
                        const errorMessages = Object.values(error.response.data.errors)
                            .flat()
                            .join(', ');
                        toast.error(errorMessages);
                    } else {
                        toast.error(error.response?.data?.message || 'Validation failed');
                    }
                } else {
                    toast.error(error.response?.data?.message || 'Failed to update password ❌');
                }
            } finally {
                this.passwordLoading = false;
                // Reset child component loading state
                if (this.$refs.changePasswordComponent) {
                    this.$refs.changePasswordComponent.loading = false;
                }
            }
        }
    }
}
</script>

<style scoped>
.nav-pills .nav-link {
    border-radius: 0;
    color: #495057;
    transition: all 0.3s;
}

.nav-pills .nav-link:hover {
    background-color: #f8f9fa;
    color: #0d6efd;
}

.nav-pills .nav-link.active {
    background-color: #0d6efd;
    color: white;
    border-left: 3px solid #0a58ca;
}

.card {
    border: none;
    border-radius: 8px;
}

.card-header {
    border-radius: 8px 8px 0 0 !important;
}

.form-control:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
}
</style>


