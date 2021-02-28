<template>
    <div class="page">
        <div>
            <h1>LISTAS</h1>
            <router-link to="lista/1">
                <button class="btn btn-primary btn-block">Crear lista</button>
            </router-link>
        </div>
        <div class="products">
            <div v-for="(list, index) of lists">
                <Unilist v-bind:list="list" v-bind:id="list.id" />
            </div>
        </div>
    </div>
</template>

<script>
    import Unilist from '../../components/list/Unilist.vue';

    export default {
        components: { Unilist },
        created: function() {
            fetch('/listas')
                .then(response => response.json())
                .then(json => this.lists = json);
        },
        data: function() {
            return {
                lists: []
            }
        }
    }
</script>

<style scoped>
    .page {
        height: 100%;
        display: grid;
        grid-template-rows: 100px auto;
    }

    .products {
        /* height: cal(100% - 100px); */
        overflow: auto;
    }
</style>
