import VueRouter from "vue-router";
import Vue from "vue";

Vue.use(VueRouter)

//imports components
import UsersComponent from '../components/UsersComponent.vue'


//routes
const routes=[
    {path:'/',component:UsersComponent,name:'global.user'}
]

//create VueRouter object
const router=new VueRouter({
    routes,
    hashbang:false,
    mode: 'history',
})

export default router;
