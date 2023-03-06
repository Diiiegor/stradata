import './bootstrap';
import './frontend/css/app.css';


import {createApp} from 'vue'
import Home from "./frontend/Home.vue";
import router from "./frontend/routes/router";

const app =createApp({
    components: {
        Home
    },
});

app.use(router)
app.mount('#app')

window.app = app
