import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";
import _ from "lodash";

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        searchValue: {},
        auth_token: null,
        err_token:null,
        redirect:"",
    }, //end of state
    getters: {
        checkearch(state) {
            if (state.searchValue) {
                return state.searchValue;
            }
            return false;
        }, //end of checkSearch

        //this section for token
        checkToken(state) {
            return !!state.auth_token;
        }, //end of checktoken

        checkErr(state){
            return state.err_token
        },//end of checkErr

    }, //end of getters
    mutations: {
        setSearchValue(state, value) {
            state.searchValue = value.data;
            if (state.searchValue) {
                localStorage.setItem("isSearching", false);
            }
        }, //end of setSearchValue

        //this section for token
        addToken(state, auth_token) {
            if(auth_token.auth_token.state=="200"){
                state.auth_token = auth_token.auth_token;
                axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*';
                axios.defaults.headers.common.auth_token =auth_token.auth_token.token;
               /*  axios.defaults.headers.common.Authorization = "Bearer"+auth_token.auth_token.token; */
            }else{
                state.err_token=auth_token.auth_token.err;
            }

        }, //end of addToken
        removeToken(state) {
            state.auth_token = null;
            delete axios.defaults.headers.common["Authorization"];
        }, //end of removeToken

    }, //end of mutations
    actions: {
        seachVlue: _.debounce(({ commit }, users) => {
            if (users == "") {
                users = "*.*";
            }
            axios
                .get("api/users/getUser/" + users)
                .then(res => {
                    localStorage.setItem("isSearching", true);
                    commit("setSearchValue", { data: res.data });
                })
                .catch(err => {
                    console.log(err);
                });
        }, 1000), //end of debounce

        //this secton for git tooken
        signup({ commit }, payload) {
            if (payload) {
                axios
                    .post("/api/signup", payload)
                    .then(res => {
                        if (res) {
                            commit("addToken", {
                                auth_token: res.data
                            });

                        }
                    })
                    .catch(err => {
                        console.log(err);
                    });
            }
        } ,//end of addToken

        login({commit},payload){
            if(payload){
                axios.post("/api/login",payload)
                .then(res => {
                    if (res) {
                        commit("addToken", {
                            auth_token: res.data

                        });

                    }
                })
                .catch(err => {
                    console.log(err);
                });
            }
        },//end of login

        logout({commit}){
            axios.get("/api/logout")
            .then(res=>{
                commit('removeToken')
                /* window.location.href="/login" */
            })
            .catch(err=>{
                console.log(err)
            })
        },//end of logout

    } //end of actions
}); //end of Vuex

export default store;
