<template>
    <div class="mt-4">
        <div class="alert alert-dark mb-0"  data-toggle="collapse" :data-target="`#list${list.id}`" aria-expanded="false" :aria-controls="`list${list.id}`">
            {{ list.name }}
        </div>
        <div class="collapse" :id="`list${list.id}`">
            <div class="card card-body">
                <div><span class="font-weight-bold">Supermercado: </span>{{ list.market }}</div>
                <div><span class="font-weight-bold">Precio: </span>{{ list.total_price }} €</div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['list']
    }
</script>

