<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container">
                <router-link to="/" class="navbar-brand">FunMap</router-link>

                <div class="collapse navbar-collapse justify-content-end" id="navbarColor01">
                    <ul class="nav navbar-nav">
                        <router-link to="/" tag="li" exact-active-class="active" class="nav-item">
                            <a class="nav-link">Map</a>
                        </router-link>
                        <router-link to="/add" tag="li" exact-active-class="active" class="nav-item">
                            <a class="nav-link">Add Point</a>
                        </router-link>
                    </ul>
                </div>
            </div>
        </nav>
        <router-view></router-view>
    </div>
</template>

<style>
    body {
        background-color: #ebf4fb;
    }
</style>


<script>
    import toastr from 'toastr'

    export default {
        created() {
            axios.get('/initdata')
            .then(r => {
                this.$store.commit('initData', r.data)
            })
            .catch(e => {
                toastr.warning('We\'re sorry, something went wrong with points, try later')
            })
        }
};
</script>
