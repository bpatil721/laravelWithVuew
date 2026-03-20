<template>
    <form @submit.prevent="updateProfile" enctype="multipart/form-data">
        <div class="mb-4 text-center">
            <img :src="profileImagePreview" alt="profile image" class="rounded-circle" style="width: 100px; height: 100px;">
        </div>
        <div class="mb-4">
            <label for="name" class="form-label">Name</label>
            <input type='text' v-model='name' class='form-control'>
        </div>
        <div class="mb-4">
            <label for="email" class="form-label">Email</label>
            <input type='email' v-model='email' class='form-control'>
        </div>
        <div class="mb-4">
            <label for="profile_image" class="form-label">Profile Image</label>
            <input type='file' @change='handleProfileImageChange'  class='form-control'>
        </div>
        <button type='submit' class='btn btn-primary'>Update Profile</button>
    </form>
</template>

<script>
export default {
    data() {
        return {
            name: '',
            email: '',
            profile_image: null,
            profileImagePreview: ''
        }
    },
    props: {
        user:{
            type:Object,
            required:true
        },
    },
    mounted(){
        this.name=this.user.name;
        this.email=this.user.email;
        this.profile_image=this.user.profile_image;
    },
    methods:{
        handleProfileImageChange(event){
            const file = event.target.files[0];
            if(file){
                this.profile_image = file;
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.profileImagePreview = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        },
        updateProfile(){
            this.$emit('update-profile', {name: this.name, email: this.email, profile_image: this.profile_image});
        }
    }
}
</script>