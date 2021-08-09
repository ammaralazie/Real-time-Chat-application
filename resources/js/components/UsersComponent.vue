<style lang="scss">
/* pagination */
.page-item {
    height: 50px;
    display: flex;
    justify-content: space-between;
    /*  padding: 0px 10px 0px 10px; */
    align-items: center;
    background: rgb(13 110 253);
    border-radius: 4px;
    color: rgb(255 255 255);
    margin: auto;
    margin-bottom: 10px;
    .page-class {
        width: 50px;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 3px;
        &:not(:last-child) {
            border-left: 1px solid;
        }
        .page-link-class {
            text-decoration: none;
            color: #fff;
            word-spacing: 10px;
        }
    }
    .active {
        background: rgb(177 174 191);
    }
    .prev-class,
    .next-class {
        width: 50px;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        &.disabled {
            display: none;
        }
    }
    .next-class {
        border-left: 1px solid;
    }
}
/* /pagination */
</style>
<template>
    <div class="rootUser" style="display:flex;flex-direction: column;">
        <ul class="wepperUser">
            <li class="cards" v-for="user in users" :key="user.id">
                <div class="card card-margin">
                    <div class="card-header no-border">
                        <h5 class="card-title">{{ user.username }}</h5>
                    </div>
                    <div class="card-body pt-0">
                        <div class="widget-49">
                            <img :src="user.img" alt="" />
                            <hr />
                            <div
                                class="widget-49-meeting-action"
                                style="    transform: translateX(30px);"
                            >
                                <a href="#" class="btn btn-sm btn-primary"
                                    >Send message
                                    <img
                                        src="https://img.icons8.com/ios-glyphs/30/000000/filled-sent.png"
                                /></a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <div v-show="searchValue"></div>
        <paginate
            v-if="last_page > 1 && dontSearch"
            :page-count="last_page"
            :click-handler="getUser"
            :prev-text="'Prev'"
            :page-range="5"
            :next-text="'Next'"
            :container-class="'page-item'"
            :page-class="'page-class'"
            :page-link-class="'page-link-class'"
            :prev-class="'prev-class'"
            :next-class="'next-class'"
        >
        </paginate>
    </div>
</template>

<script>
export default {
    data() {
        return {
            users: {},
            last_page: null,
            dontSearch: true
        };
    }, //end of data
    mounted() {
        this.getUser();
    }, //end of mounted

    methods: {
        getUser(page) {
            axios
                .get("/api/users?page=" + page)
                .then(res => {
                    this.last_page = res.data.last_page;
                    this.users = res.data.data;
                })
                .catch(err => {
                    console.log(err);
                });
        } //end of getUser
    }, //end of methods

    computed: {
        searchValue() {
            return this.$store.getters.checkearch;
        }
    },
    watch: {
        searchValue(x) {
            if (x.data) {
                //this section when the input for the search is empty
                //will do redirect to all users and this page containe on pagination
                this.users = x.data;
                this.dontSearch = true;
            } else {
                this.users = x;
                this.dontSearch = false;
            }
        }
    } //end f watch
};
</script>
