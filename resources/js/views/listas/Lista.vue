<template>
    <div class="page">
        <Modal>
            <div v-if="transaction.state == 'none'"><Loader /></div>
            <div v-if="transaction.state == 'success'"><Success v-bind:msg="transaction.message" url="listas" /></div>
            <div v-if="transaction.state == 'error'"><Error v-bind:msg="transaction.message" /></div>
        </Modal>
        <div>
            <h1>Lista</h1>
            <hr>
        </div>
        <div id="carouselExampleControls" class="carousel slide" data-interval="false">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="p-4">
                        <button class="btn btn-primary btn-block" @click="addProduct()">
                            <i v-bind:class="['fas fa-microphone', microOpen ? 'text-danger' : 'text-muted']"></i>
                            Añadir producto
                        </button>
                        <div class="product-list">
                            <div v-for="(producto, index) of productos">
                                <div class="product d-flex justify-content-between" :key="index">
                                    <span>{{ producto }}</span>
                                    <span @click="removeProduct(index)">&times</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="p-4">
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input class="form-control" id="name" type="text" v-model="form.name">
                        </div>
                        <div class="form-group">
                            <label for="market">Establecimiento:</label>
                            <input class="form-control" id="market" type="text" v-model="form.market">
                        </div>
                        <div class="form-group">
                            <label for="description">Descripción:</label>
                            <textarea class="form-control" id="description" rows="5" v-model="form.description"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev" style="width: 5%;">
                <span class="fas fa-caret-left fa-2x text-dark" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next" style="width: 5%;">
                <span class="fas fa-caret-right fa-2x text-dark" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div>
            <button class="btn btn-primary btn-block" @click="saveList">Guardar</button>
        </div>
    </div>
</template>

<script>
import Loader from '../../components/loader/Loader.vue';
import Modal from '../../components/loader/Modal.vue';
import Success from '../../components/loader/Success.vue';
import Error from '../../components/loader/Error.vue';

var recognition = new webkitSpeechRecognition() || new SpeechRecognition();
recognition.continuous = true;
recognition.lang = 'es';

export default {
    components: { Loader, Modal, Success, Error },
    created: function() {
        const x = this.productos;
        recognition.onresult = function(event) {
            let products = x;
            for (var i = event.resultIndex; i < event.results.length; ++i) {
                if (event.results[i].isFinal) {
                    products.push(event.results[i][0].transcript);
                    this.microOpen = false;
                    recognition.stop();
                }
            }
        };
    },
    data: function() {
        return {
            productos: [],
            microOpen: false,
            form: {
                name: '',
                description: '',
                market: '',
            },
            transaction: {
                state: 'none', // (none | success | error)
                message: ''
            },
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    },
    methods: {
        addProduct() {
            if (this.microOpen) {
                recognition.stop();
                this.microOpen = false;
            } else {
                this.microOpen = true;
                recognition.start();
            }
        },
        removeProduct(index) {
            this.productos.splice(index, 1);
        },
        saveList() {
            $('#modal').modal('show');

            let formData = new FormData();
            formData.append('name', this.form.name);
            formData.append('market', this.form.market);
            formData.append('description', this.form.description);
            formData.append('products', this.productos);

            fetch('/saveListas', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': this.csrf
                },
                body: formData,
            })
                .then(response => response.json())
                .then(json => {
                    this.transaction.state = json.success ? 'success' : 'error';
                    this.transaction.message = json.message;
                });
        }
    },
}


</script>

<style scoped>
    .page {
        display: grid;
        grid-template-rows: 80px auto 80px;
        height: 100%;
    }

    .product {
        background-color: white;
        border-radius: 10px;
        margin: 0.5em;
        padding: 0.6em;
    }

    .product-list { overflow: auto; }
</style>
