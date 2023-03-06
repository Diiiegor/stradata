<template>
    <div class="card column center">
        <div class="search-form">
            <div class="row">
                <div class="column">
                    <small>Nombres y apellidos</small>
                    <input type="text" placeholder="Nombres y apellidos" v-model="name">
                </div>
                <div class="column">
                    <small>Porcentaje coincidencia</small>
                    <input type="number" placeholder="Porcentaje coincidencia" v-model="percentage">
                </div>
            </div>
            <div>
                <button @click="handleSearch">Buscar</button>
            </div>
        </div>
        <div class="search-result">
            <table>
                <thead>
                <tr>
                    <th class="text-start">Nombre</th>
                    <th class="text-center">Tipo Persona</th>
                    <th class="text-center">Cargo</th>
                    <th class="text-center">Departamento</th>
                    <th class="text-center">Municipio</th>
                    <th class="text-center">Coincidencia</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="person in people">
                    <td class="text-start">{{person.nombre}}</td>
                    <td class="text-center">{{person.tipo_persona}}</td>
                    <td class="text-center">{{person.tipo_cargo}}</td>
                    <td class="text-center">{{person.departamento}}</td>
                    <td class="text-center">{{person.municipio}}</td>
                    <td class="text-center">{{person.coincidencia}}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="load-more">
            <button @click="handleLoadMore">Cargar mas</button>
        </div>

    </div>
</template>

<script>
import {search} from "../../services/searchService";

export default {
    name: "Search",
    data(){
        return {
            page:1,
            name:null,
            percentage:null,
            people:[],
            error:null
        }
    },
    methods:{
        handleSearch(){
            this.page = 1
            search(this.name,this.percentage,this.page).then( response => {
                if (!response.error){
                    this.people = response.data
                }
            })
        },
        handleLoadMore(){
            this.page ++
            search(this.name,this.percentage,this.page).then( response => {
                if (!response.error){
                    this.people = [...this.people,...response.data]
                }
            })
        }
    }
}
</script>

<style scoped>

</style>
