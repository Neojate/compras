<template>
    <div class="vue-page">
        <Navbar :user="user"></Navbar>
        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    import Navbar from '../components/navbar/Navbar.vue';

    export default {
        components: { Navbar },
        props: ['user']
    }
</script>

<style>
    .vue-page {
        height: 100%;
        background: linear-gradient(0, #bbb,  #fff2cc 60%);;
    }

    .container {
        height: calc(100% - 56px);
    }
</style>
