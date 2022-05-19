import Vue from 'vue'
import VueRouter from 'vue-router'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import VueSimpleAlert from "vue-simple-alert";
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(VueRouter)
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(VueSimpleAlert);


import user from './views/product/Product'
import addProduct from './views/product/AddProduct'
import updateProduct from './views/product/UpdateProduct'
import login from './views/auth/Login'
import register from './views/auth/Register'
import notFound from './views/auth/NotFound'
import welcome from "./components/Welcome";

export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '*',
            component:notFound,
        },
        {
            path: '/',
            component:welcome,
        },
        {
            path: '/register',
            name:'register',
            component:register,
        },
        {
            path: '/login',
            name:'login',
            component:login,
        },
        {
            path: '/admin/product',
            name:'crud',
            component:user,
            beforeEnter:(to,from,next)=>{
                axios.get('/api/authenticated').then(()=>{
                    next()
                }).catch(()=>{
                    return next({name:'login'})
                })
            }
        },

        {
            path: '/admin/add/product',
            name:'addProduct',
            component:addProduct,
        },
        {
            path: '/admin/edit/product/:id',
            name:'editProduct',
            component:updateProduct,
        },

    ],
});


