<template>
    <div>
        <Header :user="user" :login="login" />
        <NewCollection />
    </div>
</template>

<script>
import Header from './Header.vue';
import NewCollection from './NewCollection.vue';

export default {
    components: {
        Header,
        NewCollection
    },
    props: {
        user: { type: Object, default: null },
        login: { type: Boolean, default: false }
    }
}
</script>
