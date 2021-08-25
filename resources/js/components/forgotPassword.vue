<style lang="scss" scoped>
.forgot {
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    form {
        input {
            height: 50px;
            padding-left: 4px;
        }
    }
}
</style>
<template>
    <div class="forgot">
        <form method="post">
            <p
                style="color: rgb(173, 25, 25);
                                font-size: 10px;
                                /* height: 13px; */
                                padding: 10px;
                                margin: 0px;
                                text-align: left;
                                width: 100%;
                                font-size: 16px;
                                height: 35px;
                                padding:6px"
            >
                {{emailValidate}}
            </p>
            <input
                type="text"
                name="identfy"
                placeholder="Enter your email"
                required
                id=""
                v-model="email"
            />
            <button
                class="button-form btn btn-primary"
                type="submit"
                @click.prevent="sendEmail"
            >
                Send
            </button>
        </form>
    </div>
</template>

<script>
export default {
    name: "Forgot",
    data() {
        return {
            email: "",
            emailValidate: ""
        };
    }, //end of data
    methods: {
        sendEmail() {
            if (
                !/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(
                    this.email
                )
            ) {
                this.emailValidate = "Please enter the email correctly";
            }else{
                //here make request tofunction and validate the email if the email is find or no
                //if find this email we will end the link contain on token
                this.emailValidate = "";

                axios.post("/api/forgot",{
                    email:this.email
                })
                .then(res=>{
                    if(res.data.state == "404"){
                        this.emailValidate=res.data.err
                    }else{
                        this.emailValidate=""
                        this.$store.state.redirect="token"
                        console.log(res.data)
                    }

                })
                .catch(err=>console.log(err))
            }//end of if
        } //end of senEmail
    } //eand of methods
};
</script>
