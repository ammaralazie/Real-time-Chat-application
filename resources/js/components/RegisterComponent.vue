<template>
    <!-- container -->
    <div class="container">
        <!-- wepper -->
        <div class="wepper">
            <!-- login -->
            <div class="login">
                <!-- form -->
                <form  method="post">
                    <input type="text"  name="username" placeholder="username" v-model="username"  required id="username">
                    <small
                    id="emailHelp"
                    v-text="checkUsername"
                    class="form-text text-muted"
                ></small>
                    <input type="email" name="email" placeholder="email" v-model="email"  required id="">
                    <small
                    id="emailHelp"
                    v-text="checkEmail"
                    class="form-text text-muted"
                ></small>
                    <input type="password" name="password" placeholder="password" v-model="password" required id="">
                    <small
                    id="emailHelp"
                    v-text="checkPassword"
                    class="form-text text-muted"
                ></small>
                    <input type="password" name="password_confirmation" v-model="password_confirmation" placeholder="password confirm" required id="">
                    <small
                    id="emailHelp"
                    v-text="checkPasswordConfirmation"
                    class="form-text text-muted"
                ></small>
                    <button type="submit" class="btn btn-primary" :disabled="!isValid">Sign Up</button>
                </form>
                <!-- form -->
            </div>
            <!-- login -->
        </div>
        <!-- /wepper -->
    </div>
    <!-- /container -->
</template>

<script>
export default {
    data(){
        return{
            username:"",
            email:"",
            password:"",
            password_confirmation:""
        }
    },//end of data
    computed: {
        checkUsername(){
            if(this.username.length>0 && this.username.length<2){
                return "... must be more than 2 => "+this.username.length;
            }
        },//end of checkUsername

        checkEmail(){
            if(this.email.length>0 &&  !/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(this.email))
            {
                return '... must like exmpale@exmaple.com';
            }
        },//end of checkEmail

        checkPassword(){
            if (this.password.length>0 && this.password.length<8){
                return "... must be more than 8 => "+this.password.length;
            }
        },//end of checkPassword
        checkPasswordConfirmation(){
            if((this.password != this.password_confirmation) && (this.password_confirmation.length>0)){
                return '... this password do not match'
            }
        },//end of checkPassordConfirmation
        isValid(){
            if(
                (this.username.length>0 && this.username.length>=2) &&
                (this.email.length>0 &&  /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(this.email)) &&
                (this.password.length>0 && this.password.length>=8) &&
                (this.password == this.password_confirmation)
            ){
                return 'Ok'
            }
        }
    },
}
</script>
