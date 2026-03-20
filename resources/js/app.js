import { createApp } from 'vue';
import App from './App.vue';
import { createPinia } from 'pinia'

import Toast, { POSITION } from "vue-toastification";
import "vue-toastification/dist/index.css";

const app = createApp(App);

const pinia = createPinia();

app.use(pinia);
app.use(Toast, {
    position: POSITION.TOP_RIGHT,
    timeout: 3000,
});

app.mount('#app');
