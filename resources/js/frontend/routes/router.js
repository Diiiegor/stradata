import Login from "../pages/login/Login.vue";
import Search from "../pages/search/Search.vue";
import {createRouter, createWebHashHistory} from 'vue-router'
import {isLogged} from "../auth/auth";

const routes = [
    {path: '/', component: Login, name: 'home'},
    {path: '/login', component: Login, name: 'login'},
    {path: '/search', component: Search, name: 'search'},
    {path: '/:pathMatch(.*)*', name: 'NotFound', component: Login},

]

const router = createRouter({
    history: createWebHashHistory(),
    routes
})

router.beforeEach(async (to, from) => {
    const logged = isLogged()
    if (logged && to.name === 'login' || to.name === 'home') {
        return {name: 'search'}
    }
    if (!logged && to.name !== 'login') {
        return {name: 'login'}
    }
})

export default router;
