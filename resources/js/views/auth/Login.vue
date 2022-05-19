<template>
    <b-row>
        <b-col cols="4" class="mt-2 mx-auto">
            <h1 class="text-center">Login</h1>
            <b-form>

                <b-alert show variant="danger" v-if="errors">
                    <ul v-for="err in errors">
                        <li>{{ err[0] }}</li>
                    </ul>
                </b-alert>
                <b-alert show variant="danger" v-if="error">
                    <ul>
                        <li>{{ error }} </li>
                    </ul>
                </b-alert>

                <b-form-group for="email" label="Enter email" label-for="email">
                    <b-form-input id="email" type="email" v-model="form.email"/>
                </b-form-group>

                <b-form-group for="password" label="Enter password" label-for="password">
                    <b-form-input id="password" autocomplete="on" type="password" v-model="form.password"/>
                </b-form-group>

                <b-row>
                    <b-col cols="6">
                        <b-button class="w-100" variant="primary" type="button" @click="login()">submit</b-button>
                    </b-col>
                    <b-col cols="6">
                        <b-button class="w-100" variant="danger" type="reset">reset</b-button>
                    </b-col>
                </b-row>
            </b-form>
        </b-col>
    </b-row>


</template>
<script>
export default {
    data: () => ({
        form: {
            email: "",
            password: "",
        },
        errors: "",
        error: ""
    }),
    methods: {
        login() {
            this.errors = ''
            this.error = ''
            axios
                .post('/api/login/', this.form)
                .then(res => {
                    if (res.data.status) {
                        localStorage.setItem('status', res.data.status)
                        this.$router.push({name: 'crud'});
                    } else {
                        this.error = 'User not found'
                    }
                })
                .catch(err => {
                    this.errors = err.response.data.message;
                });

        }
    }
}
</script>

