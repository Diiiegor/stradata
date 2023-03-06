<template>
    <div class="card column center">

        <div class="search-result scroll-x">
            <div v-for="log in logs">
                <div><b>Driver: {{log.driver}}</b></div>
                <div>
                    <b>Query:</b>
                    {{log.query}}
                    <br>
                </div>
                <div>
                    <b>Results:</b>
                    {{log.results}}
                    <br>
                </div>
                <hr>
            </div>
        </div>
        <div class="load-more">
            <button @click="handleLoadMore">Cargar mas</button>
        </div>

    </div>
</template>

<script>
import {fetchLogs} from "../../services/logService";

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
            fetchLogs(this.page).then(response => {
                if (!response.error) {
                    this.logs = [...this.logs, ...response.data]
                }
            })
        }
    },
    mounted() {
        fetchLogs(this.page).then(response => {
            if (!response.error) {
                this.logs = response.data
            }
        })
    }
}
</script>

<style scoped>

</style>
