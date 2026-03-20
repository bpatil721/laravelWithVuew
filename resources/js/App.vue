<template>
    <component :is="componentName" v-bind="propsData" />
</template>

<script>
import Posts from './components/Post.vue';
import LoginForm from './components/LoginForm.vue';
import Profile from './components/Profile.vue';
import ChangePassword from './components/ChangePassword.vue';
import NewCollection from './components/NewCollection.vue';
import SingleProduct from './components/SingleProduct.vue';


export default {
    components: {Posts, LoginForm, Profile,ChangePassword,NewCollection,SingleProduct},
    data() {
        return {
            componentName: null,
            propsData: {},
        }
    },
    mounted() {
        const app = document.getElementById('app')
        this.componentName = app.dataset.component;

        if(app.dataset.props) {
            this.propsData = JSON.parse(app.dataset.props)
        }

    }
}
</script>