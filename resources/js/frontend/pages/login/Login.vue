<template>
    <div class="login">
        <div class="login-container shadow">
            <div>
                Ingresar
                <hr>
            </div>
            <input type="text" v-model="email">
            <input type="password" v-model="password">
            <button @click="handleLogin">Login</button>
        </div>
    </div>
</template>

<script>
import {login} from "../../services/authService";
import {setLogin} from "../../auth/auth";

export default {
    name: "Login",
    data() {
        return {
            email: 'test@example.com',
            password: 'password'
        }
    },
    methods: {
        handleLogin() {
            if (this.email && this.password) {
                login(this.email,this.password).then( response => {
                    if (!response.error){
                        setLogin(response.data.access_token)
                        this.$router.push('search')
                    }
                })
            }
        }
    }
}
</script>

<style scoped>

</style>
