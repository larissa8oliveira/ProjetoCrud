import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import Multiselect from 'vue-multiselect';

const app = createApp(App);

app.component('multiselect', Multiselect);

app.use(router);

app.mount('#app');
