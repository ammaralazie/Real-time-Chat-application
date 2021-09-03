<template>
    <!-- container -->
    <div class="container">
        <!-- wepper -->
        <div class="wepper">
            <!-- login -->
            <div class="login">
                <!-- form -->
                <form method="post">
                    <p
                        style="color: rgb(173 25 25);
                                font-size: 10px;
                                height: 13px;
                                margin: 0px;
                                text-align: left;"
                    >
                        {{ err_token }}
                    </p>
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
                    <div class="password-eye">
                        <i class="far fa-eye" @click="showPssword"></i>
                        <input
                            type="password"
                            name="password"
                            placeholder="password"
                            required
                            id=""
                            v-model="password"
                        />
                    </div>

                    <small
                        id="emailHelp"
                        v-text="checkPassword"
                        class="form-text text-muted"
                    ></small>
                    <button
                        :disabled="!isValid"
                        class="button-form btn btn-primary"
                        @click.prevent="checkButton"
                        type="submit"
                    >
                        Login
                    </button>
                    <!-- forgot passsword -->
                    <div class="forgot-password">
                        <router-link to="/forgot">forgot password?</router-link>
                    </div>
                    <!-- /forgot password -->
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

            identfy: "",
            password: "",

            payload: {},
            err_tokn: ""
        };
    }, //end data
    computed: {
        checkUsername() {
            if (this.identfy.length > 0 && this.identfy.length < 2) {
                return "... must be more than 2 ";
            }
        }, //end of checkUsername

        checkPassword() {
            if (this.password.length > 0 && this.password.length < 8) {
                return "... must be more than 8 => " + this.password.length;
            }
        }, //end of checkPassword
        isValid() {
            if (
                this.identfy.length > 0 &&
                this.password.length > 0 &&
                this.password.length >= 8
            ) {
                return "Ok";
            }
        }, //gkghkggjk
        err_token() {
            this.err_tokn = this.$store.getters.checkErr;
            return this.err_tokn;
        } //end of  err_token
    },
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
                var password = document.querySelector("input[name=password]");
                password.type = "password";
            }

            this.payload = {
                identfy: this.identfy,
                password: this.password
            };
            this.$store.dispatch("login", this.payload);
        } //end checkButton
    } //end methods
};
</script>
