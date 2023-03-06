<template>
    <div class="main">
        <header class="main--header shadow" v-if="showLogOut">
            <RouterLink to="search">Buscador</RouterLink>
            <a href="">Logs</a>
            <a href="#" @click="handleLogOut">Salir</a>
        </header>
        <router-view/>
    </div>
</template>

<script>
import {logout, isLogged} from "./auth/auth";

export default {
    name: "Home",
    data() {
        return {
            showLogOut: false
        }
    },
    methods: {
        handleLogOut() {
            logout()
            this.showLogOut = isLogged()
            this.$router.push('login')
        },
    },
    watch: {
        '$route'(to, from) {
            this.showLogOut = isLogged()
        }
    },
    mounted() {
        this.showLogOut = isLogged()
    }
}
</script>

