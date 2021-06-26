var eye=document.getElementsByClassName('fa-eye')[0];
var button=document.getElementsByClassName('button-form')[0];
var password=document.querySelector('input[name=password]');
x='show';

// section show password
eye.addEventListener('click',function(e){
    console.log(x);
    if(x=='show'){
        password.type='text';
        x='hidden';
        this.style.color='rgb(33, 189, 93)'
    }else{
        password.type='password';
        x='show';
        this.style.color='#313131'
    }
})
// end of section show password

// convert to password and submit
button.addEventListener('submit',function(){

    if (x != 'show'){
        password.type='password';
        this.closest('form').submit();
    }
})