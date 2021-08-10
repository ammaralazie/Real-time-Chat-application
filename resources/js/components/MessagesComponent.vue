<style lang="scss" scoped>
p {
    margin-bottom: 0px;
}
.MessagesUsers {
    margin: auto;
    width: 80%;
    margin-top: 70px;
}
#a_submit {
    width: 100%;
}
.card {
    display: flex;
    justify-content: space-between;
    flex-direction: row;
}
</style>
<template>
    <div class="MessagesUsers">
        <!-- my icon -->
        <div class="my-icon">
            <!-- left side -->
            <div class="left-side">
                <i @click="$router.go(-1)" class="fas fa-arrow-left"></i>
                <div v-if="AuthUser">
                    <img :src="AuthUser.data.img" alt="" />
                    <div class="nick-name">
                        <p v-text="AuthUser.data.username"></p>
                        <p>Active Now <span></span></p>
                    </div>
                </div>
            </div>
            <!-- //left side -->
            <!-- right side -->
            <div v-text="time" class="hours"></div>
            <!-- //right side -->
        </div>
        <!-- //my icon -->

        <!-- liist user -->
        <ul class="list-users" v-if="users">
            <!-- card -->
            <li v-for="user in users" :key="user.id">
                <form id="send_username" method="post">
                    <!-- اهنا لازم نعطي username لكل مستخدم -->
                    <input
                        type="hidden"
                        value="user.username"
                        name="username"
                    />
                    <button id="a_submit">
                        <router-link :to="'message/' + user.username">
                            <div class="card">
                                <div class="icon-user">
                                    <img :src="user.img" alt="" />
                                    <div>
                                        <p class="username">
                                            {{ user.username }}
                                        </p>
                                        <p
                                            class="last-message"
                                            style="color:rgb(134, 132, 132) "
                                        >
                                            {{ user.msg.content }}
                                        </p>
                                        <p class="last-message">
                                            <input
                                                type="hidden"
                                                name="state"
                                                value="1"
                                            />
                                            <!--   {{ $user->messages->reverse()->first()->content }} -->
                                        </p>
                                    </div>
                                </div>
                                <div class="state-user">
                                    <span></span>
                                </div>
                            </div>
                        </router-link>
                    </button>
                </form>
            </li>
            <!-- //end of v-for  -->

            <!-- //card -->
        </ul>
        <!-- //list user -->
        <div v-text="getTime"></div>
    </div>
    <!-- /MessagesUsers -->
</template>

<script>
export default {
    data() {
        return {
            users: [],
            AuthUser: this.$store.state.auth_token,
            time: ""
        };
    }, //end of data

    created() {
        this.getMessagesUsers();
        this.getTime();
    }, //end of mounted

    methods: {
        getTime() {
            this.time = setInterval(() => {
                var date = new Date();
                var hur = date.getHours();
                /* var sec = date.getSeconds(); */
                var min = date.getMinutes();
                if (hur > 12) {
                    this.time = hur + ":" + min + " PM";
                } else {
                    this.time = hur + ":" + min + " AM";
                } //end of if

                /* console.log(x); */
            }, 100);
        }, //end of gettime

        getMessagesUsers() {
            if (this.AuthUser) {
                axios
                    .get("/api/messages-users")
                    .then(res => {
                        this.users = res.data.data;
                    })
                    .catch(err => {
                        console.log(err);
                    });
            } else {
                this.$store.state.redirect = "/login";
            }
        }, //end of getMessageUsers


    } //end of methods
};
</script>
