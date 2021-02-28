<template>
    <div class="text-center">
        <i class="fas fa-exclamation-circle"></i>
        <span>{{ msg }}</span>
        <button class="btn btn-danger btn-block mt-4" @click="goBack()">Volver</button>
    </div>
</template>

<script>
    export default {
        props: ['msg'],
        methods: {
            goBack() {
                $('#modal').modal('hide');
            }
        }
    }

</script>
