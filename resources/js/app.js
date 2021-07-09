const { default: Axios } = require('axios');
const { default: Echo } = require('laravel-echo');


require('./bootstrap');
window.Echo.private("chat-prvate." +localStorage.getItem("sndUsr")+'.'+localStorage.getItem('rcvUsr'))
.listen(".chat-p",(e)=>{
    console.log(e);
});
