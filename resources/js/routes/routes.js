import VueRouter from "vue-router";
import Vue from "vue";

Vue.use(VueRouter)

//imports components
import UsersComponent from '../components/UsersComponent.vue'
import LoginComponent from '../components/LoginComponent.vue'
import RegisterComponent from '../components/RegisterComponent.vue'
import MessagesComponent from '../components/MessagesComponent.vue'

//routes
const routes=[
    {path:'/',component:UsersComponent,name:'global.user'},
    {path:'/login',component:LoginComponent,name:'login.user'},
    {path:'/signup',component:RegisterComponent,name:'signup.user'},
    {path:'/messages-users',component:MessagesComponent,name:'messsages.user'}
]


//create VueRouter object
const router=new VueRouter({
    routes,
    hashbang:false,
    mode: 'history',
})

export default router;
