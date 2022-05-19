<template>
    <b-row>
        <b-col cols="4" class="mt-2 mx-auto">
            <h1 class="text-center">Register</h1>
            <b-form>
                <b-alert show variant="danger"  v-if="errors">
                    <ul  v-for="err in errors">
                        <li>{{err[0]}} </li>
                    </ul>
                </b-alert>
                        <b-form-group for="name" label="Enter name" label-for="name">
                            <b-form-input id="name" type="text" v-model="form.name"/>
                        </b-form-group>
                <b-form-group for="email" label="Enter email" label-for="email">
                    <b-form-input id="email"  type="email" v-model="form.email" />
                </b-form-group>

                <b-form-group for="password" label="Enter password" label-for="password">
                    <b-form-input id="password"  autocomplete="on"  type="password" v-model="form.password" />
                </b-form-group>

                <b-form-group for="password_confirmation" label="Confirm password" label-for="password_confirmation">
                    <b-form-input id="password_confirmation" autocomplete="on" type="password" v-model="form.password_confirmation" />
                </b-form-group>
                <b-row>
                    <b-col cols="6">
                        <b-button class="w-100" variant="primary" type="button" @click="register()">submit</b-button>
                    </b-col>
                    <b-col cols="6">
                        <b-button  class="w-100" variant="danger" type="reset">reset</b-button>
                    </b-col>
                </b-row>
            </b-form>
        </b-col>
    </b-row>


</template>
<script>
export default{
    data:()=>({
        form:{
            name:"",
            email:"",
            password:"",
            password_confirmation:"",
        },
        errors:"",
    }),
    methods:{
        register(){
            axios
                .post('/api/register/',this.form)
                .then(res=>{
                    if(res.data.status){
                        this.$router.push({name:'login'});

                    }
                })
                .catch(err=>{
                    this.errors = err.response.data.message;
                });
        }
    }
}
</script>

