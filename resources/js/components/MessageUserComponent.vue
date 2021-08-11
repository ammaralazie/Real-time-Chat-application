<template>
    <div class="MessageUser">
        <div class="background_image">
            <!-- we set background Image -->
            <img src="/media/backgroundMessage/1.jpg" alt="" />
        </div>
        <!-- consignee -->
        <div class="consignee">
            <!-- contente-users -->
            <div class="contente-users" v-if="info">
                <i class="fas fa-arrow-left" @click="$router.go(-1)"></i>
                <div>
                    <!-- here we set imge of the recive user -->
                    <img :src="info.rcv_usr.img" alt="" />
                    <div>
                        <!-- here we set username of the recive user -->
                        <p v-text="info.rcv_usr.username"></p>
                    </div>
                </div>
            </div>
            <!-- contente-users -->
            <!-- body of message -->
            <div class="message-cover">
                <!-- we put the tags from methods sendTogetAllMessage -->
            </div>
            <!-- //body of message -->

            <!-- form message -->
            <div class="form-message">
                <form method="post" action="" id="data" v-if="info">
                    <input
                        type="hidden"
                        name="sendUsr"
                        v-model="AuthUsr.data.id"
                    />

                    <!-- mast value assignment for reciveUser -->
                    <input
                        type="hidden"
                        name="reciveUsr"
                        v-model="info.rcv_usr.id"
                    />
                    <input
                        type="text"
                        name="message"
                        placeholder="your message ..."
                    />

                    <!-- this button to send message to another user -->
                    <button id="send" @click.prevent="senMessageUser">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
            <!-- //form message -->
        </div>
        <!-- //consignee -->
    </div>
</template>

<script>
export default {
    data() {
        return {
            AuthUsr: this.$store.state.auth_token,
            info: null
        };
    }, //end of data

    created() {
        this.sendTogetAllMessage();
        this.senMessageUser();
    }, //end of created
    methods: {
        //this function will recive all message  from vuex file and proccesing here
        sendTogetAllMessage() {
            if (this.AuthUsr) {
                axios
                    .post("/api/message/", {
                        username: this.$route.params.username
                    })
                    .then(res => {
                        if (res.data.data) {
                            this.info = res.data.data;
                            let usrId = this.AuthUsr.data.id;
                            let obj2 = [];
                            let recivephoto = this.info.rcv_usr.img;
                            //foreach to object and save messsage in array
                            $.each(this.info.all_msg, (ky, value) => {
                                $.each(value, function(key, value) {
                                    obj2[ky] = value;
                                });
                            }); //end of for each;

                            //sort array by created at field
                            let newobj = obj2.sort(function(a, b) {
                                return (
                                    new Date(a.created_at) -
                                    new Date(b.created_at)
                                );
                            });
                            //end of sort
                            var bdy = document.body;
                            for (var i = 0; i < newobj.length; i++) {
                                if (obj2[i].user_id == usrId) {
                                    var myMessage = document.createElement(
                                        "div"
                                    );
                                    myMessage.classList = "my-message";

                                    var createP = document.createElement("p");
                                    createP.textContent = newobj[i].content;
                                    myMessage.appendChild(createP);

                                    var messageCover = document.getElementsByClassName(
                                        "message-cover"
                                    )[0];
                                    messageCover.appendChild(myMessage);
                                } else {
                                    var yourMessage = document.createElement(
                                        "div"
                                    );
                                    yourMessage.classList = "your-message";
                                    var youPhoto = document.createElement(
                                        "div"
                                    );
                                    youPhoto.classList = "your-photo";
                                    var photo = document.createElement("img");
                                    photo.src = recivephoto;
                                    youPhoto.appendChild(photo);
                                    yourMessage.appendChild(youPhoto);

                                    var contentMessage = document.createElement(
                                        "div"
                                    );
                                    contentMessage.classList =
                                        "content-your-message";
                                    var createP = document.createElement("p");
                                    createP.textContent = newobj[i].content;
                                    contentMessage.appendChild(createP);

                                    var messageCover = document.getElementsByClassName(
                                        "message-cover"
                                    )[0];
                                    messageCover.appendChild(yourMessage);
                                    yourMessage.appendChild(contentMessage);
                                    messageCover.appendChild(yourMessage);
                                } //end of if
                            } //end of for i
                            var messageCover = document.getElementsByClassName(
                                "message-cover"
                            )[0];
                            messageCover.scrollTop = messageCover.scrollHeight;
                        } //end of if
                    }) //end of res
                    .catch(err => {
                        console.log(err);
                    }); //end of catch
            } else {
                this.$store.state.redirect = "/login";
            }
        }, //end of reciveAllMessage

        senMessageUser() {
            var frm = $("#data");
            if (frm.serialize()) {
                axios
                    .post("/api/recive-message/", frm.serialize())
                    .then(res => {
                            //show my message in container
                            let msg = document.querySelector(
                                "input[name=message]"
                            );
                            var myMessage = document.createElement("div");
                            myMessage.classList = "my-message";
                            var createP = document.createElement("p");
                            createP.textContent = msg.value;
                            myMessage.appendChild(createP);

                            var messageCover = document.getElementsByClassName(
                                "message-cover"
                            )[0];
                            messageCover.appendChild(myMessage);
                            msg.value = "";
                            var messageCover = document.getElementsByClassName(
                                "message-cover"
                            )[0];
                            messageCover.scrollTop = messageCover.scrollHeight;
                            //end of show my message in container

                    })
                    .catch(err => console.log(err)); //end of ajax
            } //end of if frm
        } //end of senMessageUser
    } //end of methods
};
</script>
