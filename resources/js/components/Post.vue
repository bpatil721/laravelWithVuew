<template>
<div class="container">
    <div class="col-md-4">
        <form @submit.prevent="editModal ? updatePost() : createPost()">
            <div class="form-group mb-3">
                <label for="title">Title</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="title" 
                    v-model="title"
                    :class="{ 'is-invalid': errors.title }"
                >
                <small class="text-danger" v-if="errors.title">{{ errors.title[0] }}</small>
            </div>
            <div class="form-group mb-3">
                <label for="content">Content</label>
                <textarea 
                    class="form-control" 
                    id="content" 
                    v-model="content"
                    :class="{ 'is-invalid': errors.content }"
                ></textarea>
                <small class="text-danger" v-if="errors.content">{{ errors.content[0] }}</small>
            </div>
            <button type="submit" class="btn btn-primary" v-if="!editModal">Create</button>
            <button type="submit" class="btn btn-primary" v-else>Update</button>
        </form>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <tr v-for="post in posts" :key="post.id">
                    <td> {{post.title}} </td>
                    <td> {{post.content}} </td>
                    <td> 
                        <button class="btn btn-primary" @click='editPost(post.id)'>Edit</button>
                        <button class="btn btn-danger" @click="deletePost(post.id)">Delete</button> 
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</template>
<script>
import axios from 'axios';

export default {
    data() {
        return {
             id: null,
            title: '',
            content:'',
            posts: [],
            errors: {},
            editModal: false,
        }
    },
    
    methods:{
 
      async getFetctPosts(url = 'api/posts') {
        try {
            const response = await axios.get(url);
            this.posts = response.data.data;
        } catch(error) {
            this.showToast('error', "Failed to load posts");
            console.error("Failed to load posts", error);
        }
      },

      async createPost(){
        // Clear previous errors
        this.errors = {};
        
        try{
         const result = await axios.post('api/posts',{
            title:this.title,
            content:this.content
         })
         
         // Success - clear form and show success message
         this.title='';
         this.content='';
         this.errors = {};
         
         // Show success toast
        
         this.$toast.success("Post created successfully ✅");;
         
         this.getFetctPosts();
        }catch(error){
           if(error.response && error.response.status == 422 ) {
                // Validation errors - show below inputs AND in toast
                this.errors = error.response.data.errors;
                
                // Show all validation errors in toast
                let errorMessages = [];
                Object.keys(this.errors).forEach(key => {
                    errorMessages.push(this.errors[key][0]);
                });
                const errorText = errorMessages.join('\n');
                this.$toast.error(errorText, { timeout: 5000 });
            } else {
                // Other errors
                const errorMessage = error.response?.data?.message || "Something went wrong ❌";
                this.$toast.error(errorMessage);
            }
        }
      },
      async deletePost(id){
        try {
            await axios.delete(`api/posts/${id}`);
            this.getFetctPosts();
            this.$toast.success("Post deleted successfully! ✅"); 
        } catch(error) {
            const errorMessage = error.response?.data?.message || "Failed to delete post ❌";
            this.$toast.error(errorMessage);
        }
      },
      async editPost(id){
         const result = await axios.get(`api/posts/${id}`);
         this.title = result.data.data.title;
         this.content = result.data.data.content;
         this.editModal = true;
         this.id = id;
      },
       async updatePost(){
        try{
            await axios.put(`api/posts/${this.id}`,{
                title: this.title,
                content: this.content
            })
            this.title = '';
            this.content = '';
            this.editModal = false;
            this.getFetctPosts();
            this.$toast.success("Post updated successfully! ✅");
        }catch(error){
           if(error.response && error.response.status == 422 ) {
                // Validation errors - show below inputs AND in toast
                this.errors = error.response.data.errors;
                
                // Show all validation errors in toast
                let errorMessages = [];
                Object.keys(this.errors).forEach(key => {
                    errorMessages.push(this.errors[key][0]);
                });
                const errorText = errorMessages.join('\n');
                this.$toast.error(errorText, { timeout: 5000 });
            } else {
                // Other errors
                const errorMessage = error.response?.data?.message || "Something went wrong ❌";
                this.$toast.error(errorMessage);
            }
        }
    },
    
    },
   
    mounted() {
      this.getFetctPosts();
    }
}
</script>