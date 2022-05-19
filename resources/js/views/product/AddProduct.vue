<template>
    <b-row>
        <b-col cols="4" class="mt-2 mx-auto">
            <h1 class="text-center">Add Product</h1>
            <b-form>
                <b-alert show variant="danger" v-if="errors">
                    <ul v-for="err in errors">
                        <li>{{ err[0] }}</li>
                    </ul>
                </b-alert>
                <b-row>
                    <b-col cols="6">
                        <b-form-group for="name" label="Author name" label-for="name">
                            <b-form-input id="name" type="text" v-model="form.name"/>
                        </b-form-group>
                    </b-col>
                    <b-col cols="6">
                        <b-form-group for="product" label="Product name" label-for="product">
                            <b-form-input id="product" type="text" v-model="form.product"/>
                        </b-form-group>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col cols="6">
                        <b-button class="w-100" variant="primary" type="button" @click="create()">submit</b-button>
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
            name: "",
            product: "",
        },
        errors: "",
    }),
    methods: {
        create() {
            axios
                .post('/api/crud', this.form)
                .then(res => {
                    if (res.data.status) {
                        this.$router.push({name: 'crud'});
                        this.$alert(res.data.message);
                    }
                })
                .catch(err => {
                    this.errors = err.response.data.message;
                });
        }
    }
}
</script>

