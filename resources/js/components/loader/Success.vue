<template>
    <div class="text-center">
        <i class="far fa-check-circle"></i>
        <span>{{ msg }}</span>
        <button class="btn btn-success btn-block mt-4" @click="goBack()">Volver</button>
    </div>
</template>

<script>
    export default {
        props: ['msg', 'url'],
        methods: {
            goBack() {
                this.$router.push({ name: this.url })
                $('#modal').modal('hide');
            }
        }
    }

</script>
