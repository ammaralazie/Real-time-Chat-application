<style lang="scss" scoped>
.validateToken {
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
    <div class="validateToken">
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
                {{tokenValidate}}
            </p>
            <input
                type="text"
                name="identfy"
                placeholder="Plase your token"
                required
                id=""
                v-model="token"
            />
            <button
                class="button-form btn btn-primary"
                type="submit"
                @click.prevent="validationToken"
            >
                Send
            </button>
        </form>
    </div>
</template>

<script>
export default {
    name:"validateToken",
    data(){
        return{
            token:'',
            tokenValidate:''
        }
    },//end of data

    methods:{
        validationToken(){
            if(this.token.length>0 && this.token.length != 32){
                this.tokenValidate= "this token is not valid"
            }else{
                 this.tokenValidate=''
                axios.post('/api/tokenValidation',{
                    token:this.token
                })
                .then(res=>{
                    if (res.data.state =='404'){
                        this.tokenValidate=res.data.err
                    }else{
                        this.tokenValidate=''
                        this.$store.state.redirect="/reset-password/"+this.token
                    }
                })
                .catch(err=>console.log(err))
            }//end of if
        },//end of validationToken
    },//end of methods
}
</script>
