<template>
    <div class="card column center">

        <div class="search-result">
            <table>
                <thead>
                <tr>
                    <th class="text-start">ID</th>
                    <th class="text-center">Driver</th>
                    <th class="text-center">Query</th>
                </tr>
                </thead>
                <tbody>
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
    name: "Logs",
    data() {
        return {
            page: 1,
            logs: [],
        }
    },
    methods: {
        handleLoadMore() {
            this.page++
            search(this.name, this.percentage, this.page).then(response => {
                if (!response.error) {
                    this.people = [...this.people, ...response.data]
                }
            })
        }
    }
}
</script>

<style scoped>

</style>
