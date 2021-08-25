<style lang="scss" scoped>
.newPassword {
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    form {
        display: flex;
        flex-direction: column;
        width: 50%;
        justify-content: center;
        align-items: center;
        input {
            height: 50px;
            padding: 4px;
            margin: 8px;
            width: 100%;
        }
    }
}
</style>

<template>
    <div class="newPassword">
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
                {{ checkPassword }}
            </p>
            <input
                type="password"
                name="identfy"
                placeholder="New Password"
                required
                id=""
                v-model="password"
            />
            <input
                type="password"
                name="identfy"
                placeholder="Confirm password"
                required
                id=""
                v-model="confirmation_password"
            />
            <button
                class="button-form btn btn-primary"
                type="submit"
                @click.prevent="changePassword"
            >
                Update
            </button>
        </form>
    </div>
</template>
<script>
export default {
    name: "resetPassword",
    data() {
        return {
            password: "",
            confirmation_password: "",
            checkPassword: ""
        };
    }, //end of data

    methods: {
        changePassword() {
            if (this.password.length > 0 && this.password.length < 8) {
                this.checkPassword = "password must be more than 8 char";
            } else if (
                this.password.length > 8 &&
                (this.password != this.confirmation_password)
            ) {
                this.checkPassword = "password do not match";
            } else {
                axios
                    .post("/api/reset-password", {
                        token: this.$route.params.token,
                        password: this.password,
                        password_confirmation: this.confirmation_password
                    })
                    .then(res => console.log(res.data))
                    .catch(err => console.log(err));
            } //end of if
        } //end of changePassword
    } //end of methods
};
</script>
