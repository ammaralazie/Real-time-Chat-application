require("./bootstrap");
window.Vue = require("vue");
import axios from "axios";
import Paginate from "vuejs-paginate";

require("./bootstrap");
Vue.component(
    "global-home",
    require("./components/GlobalComponent.vue").default
);
Vue.component(
    "user-component",
    require("./components/UsersComponent.vue").default
);

Vue.component("paginate", Paginate);

import router from "./routes/routes";
import store from "./vuex/vuex";

const app = new Vue({
    el: "#app",
    data() {
        return {
            searchUser: "",
            isSearching: false,
            user: []
        };
    }, //end of data
    props: ["loading"],
    store,
    router,
    methods: {
        showList() {
            let profileList = document.getElementsByClassName(
                "profile-list"
            )[0];
            profileList.classList.toggle("show-list");
        },
        showInputSearch() {
            console.log("user :", this.user);
            let inputSearc = document.querySelector("input[type=search]");
            inputSearc.classList.toggle("showInputSearch");
            inputSearc.style.border = "1px solid #000";
        },
        logout() {
            if (this.$store.getters.checkToken) {
                this.$store.dispatch("logout");
                router.push("/login");
            }
        }
    }, //end of methods
    computed: {
        findState() {
            return localStorage.getItem("isSearching");
        },
        hideNavBar() {
            let navBar = document.querySelector("nav");

            //this section for check to url and then hidden the navbar
            if (
                (this.$route.fullPath == "/messages-users" ||
                    this.$route.fullPath ==
                        "/message/" + this.$route.params.username) &&
                window.innerWidth < 700
            ) {
                navBar.style.display = "none";
            } else {
                navBar.style.display = "inline-block";
            }
        }, //end of  hideNavBar

        //we will make redrict after login or register
        homeRedirect() {
            if (this.$store.getters.checkToken) {
                router.push("/");
            }
        },
        loginRedirect() {
            if (this.$store.state.redirect) {
                router.push(this.$store.state.redirect);
            } //end of if
        }, //end of login redirect

        //here we will return the information user from vuex file
        users() {
            this.user = this.$store.state.auth_token;
            return this.user;
        },

        listenMessage() {
            //this section to listen of message

            console.log("work ...")
        }//end of liten meassge
    }, //end of computed

    watch: {
        searchUser(x) {
            this.$store.dispatch("seachVlue", x);
        },
        findState(x) {
            this.isSearching = x;
        }
    } //end of watch
});
