<template>
    <div class="text-center p-4">
        <Logo />
        <div class="four-division">
            <button class="btn btn-primary btn-block my-4 ">Crear lista</button>
            <button class="btn btn-primary btn-block my-4 ">Mis listas</button>
            <button class="btn btn-primary btn-block my-4 ">Ver histórico</button>
            <button class="btn btn-primary btn-block my-4 ">A comprar!</button>
        </div>
    </div>
</template>

<script>
import Logo from '../../components/logo/Logo.vue';

export default {
    name: 'Home',
    components: { Logo }
}
</script>

<style scoped>

</style>
