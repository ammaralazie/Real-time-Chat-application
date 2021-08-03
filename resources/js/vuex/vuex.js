import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";
import _ from "lodash";

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        searchValue: {},
    }, //end of state
    getters: {
        checkearch(state) {
            if (state.searchValue) {
                return state.searchValue;
            }
            return false;
        }
    }, //end of getters
    mutations: {
        setSearchValue(state, value) {
            state.searchValue = value.data;
            if(state.searchValue){
                localStorage.setItem('isSearching',false)
            }

        }
    }, //end of mutations
    actions: {
        seachVlue:_.debounce(({ commit }, users)=> {

            if(users==''){
                users="*.*"
            }
            axios
                .get("api/users/getUser/" + users)
                .then(res => {
                    localStorage.setItem('isSearching',true)
                    commit("setSearchValue", { data: res.data });

                })
                .catch(err => {
                    console.log(err);
                });
        },1000)//end of debounce
    } //end of actions
}); //end of Vuex

export default store;
