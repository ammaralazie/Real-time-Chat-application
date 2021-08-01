
require('./bootstrap');
window.Vue = require('vue');

const { default: Axios } = require('axios');
const { default: Echo } = require('laravel-echo');


require('./bootstrap');
window.Echo.private("chat-prvate." +localStorage.getItem("sndUsr")+'.'+localStorage.getItem('rcvUsr'))
.listen(".chat-p",(e)=>{
    console.log(e);
});


Vue.component('global-home', require('./components/GlobalComponent.vue').default);
Vue.component('user-component', require('./components/UsersComponent.vue').default);

import router from './routes/routes';
const app = new Vue({
    el: '#app',
    router,
    methods:{
        showList(){
            let profileList = document.getElementsByClassName('profile-list')[0]
            profileList.classList.toggle('show-list')
        }
    }
});


