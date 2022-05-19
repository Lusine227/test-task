<template>
    <div>
        <b-navbar type="dark" variant="dark">
            <b-navbar-brand router-link to="/">Test</b-navbar-brand>
            <b-navbar-nav class="ml-auto" v-if="!user">
                <b-nav-item router-link to="/login"> Login</b-nav-item>
                <b-nav-item router-link to="/register">Register</b-nav-item>
            </b-navbar-nav>
            <b-navbar-nav class="ml-auto" v-if="user">
                <b-nav-item outer-link :to="{name:'crud'}"> {{ user }}</b-nav-item>
                <b-button @click.prevent="logout">Logout</b-button>
            </b-navbar-nav>
        </b-navbar>
        <router-view/>
    </div>

</template>
<script>
export default {
    name: 'Header',
    data() {
        return {
            user: ''
        }
    },
    updated() {
        let token = localStorage.getItem('status')
        if (!this.user && token) {
            this.getUser()
        }
    },
    methods: {
        getUser() {
            axios
                .get('/api/user')
                .then(res => {
                    this.user = res.data.name
                })
        },
        logout() {
            localStorage.removeItem('status');
            axios.post('/api/logout')
            this.user = "";
            this.$router.push({name: 'login'})
        }

    }
}

</script>
