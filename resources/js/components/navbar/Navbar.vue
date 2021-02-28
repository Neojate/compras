<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <span class="subtitle">Bienvenido</span>
            <strong>{{ user }}</strong>,
        </a>
        <button class="navbar-toggler" @click="showNavbar()" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="side_bar" id="side_bar">
            <div class="text-right pr-4">
                <a href="javascript:void(0)" class="closebtn pull-right" @click="closeNavBar()">&times;</a>
            </div>
            <div>
                <a class="nav-link" href="#" @click="link('home')">Inicio</a>
                <a class="nav-link" href="#" @click="link('listas')">Mis listas</a>
                <!-- <router-link class="router-link" :to="{ name: 'listas' }">Listas</router-link> -->
                <a class="nav-link" href="#" @click="link('/caca')">Ver histórico</a>
                <a class="nav-link" href="#" @click="link('/caca')">A comprar!</a>
                <a class="nav-link" href="" @click="submit()">Salir</a>
                <form action="logout" id="form" method="POST">
                    <input name="_token" :value="csrf" type="hidden">
                </form>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    },
    props: ['user'],
    methods: {
        showNavbar() {
            document.getElementById('side_bar').style.width = '250px';
        },
        closeNavBar() {
            document.getElementById('side_bar').style.width = '0px';
        },
        submit() {
            event.preventDefault();
            document.getElementById('form').submit();
        },
        link(routeName) {
            event.preventDefault();
            this.closeNavBar();
            if (routeName === this.$router.history.current.name) {
                return;
            }
            this.$router.push({ name: routeName });
        }
    }
}
</script>

<style scoped>
.subtitle {
    font-size: 0.7em;
}

.side_bar {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 56px;
    left: 0;
    color: #fff;
    background-color: rgba(221, 221, 221, 0.9);
    overflow-x: hidden;
    transition: 0.5s;
}
.sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #818181;
    display: block;
    transition: 0.3s;
}

.sidenav a:hover {
    color: #f1f1f1;
}

.closebtn {
    font-size: 30px;
}

.router-link {
    color: white;
    display: block;
}
</style>
