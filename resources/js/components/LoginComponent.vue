<template>
    <!-- container -->
    <div class="container">
        <!-- wepper -->
        <div class="wepper">
            <!-- login -->
            <div class="login">
                <!-- form -->
                <form method="post">
                    <input
                        type="text"
                        name="identfy"
                        placeholder="email or username"
                        required
                        id=""
                        v-model="identfy"
                    />
                    <small
                        id="emailHelp"
                        v-text="checkUsername"
                        class="form-text text-muted"
                    ></small>
                    <input
                        type="password"
                        name="password"
                        placeholder="password"
                        required
                        id=""
                        v-model="password"
                    />
                    <small
                        id="emailHelp"
                        v-text="checkPassword"
                        class="form-text text-muted"
                    ></small>
                    <i class="far fa-eye" @click="showPssword"></i>
                    <button
                        :disabled="!isValid"
                        class="button-form btn btn-primary"
                        @click="checkButton"
                        type="submit"
                    >
                        Login
                    </button>
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
    data() {
        return {
            x: "show",
            identfy:"",
            password:""
        };
    }, //end data
    methods: {
        showPssword() {
            var password = document.querySelector("input[name=password]");
            if (this.x == "show") {
                password.type = "text";
                this.x = "hidden";
                /*  this.style.color = "rgb(33, 189, 93)"; */
            } else {
                password.type = "password";
                this.x = "show";
                /* this.style.color = "#313131"; */
            }
        }, //end of showPssword


        checkButton() {
            // convert to password and submit

            if (this.x != "show") {
                password.type = "password";
                closest("form").submit();
            }
        } //end checkButton
    } ,//end methods
    computed: {
        checkUsername(){
            if(this.identfy.length>0 && this.identfy.length<2){
                return "... must be more than 2 ";
            }
        },//end of checkUsername


        checkPassword(){
            if (this.password.length>0 && this.password.length<8){
                return "... must be more than 8 => "+this.password.length;
            }
        },//end of checkPassword
        isValid(){
            if(
                (this.identfy.length>0 ) &&
                (this.password.length>0 && this.password.length>=8)
            ){
                return 'Ok'
            }
        }
    },
};
</script>
