<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    {{-- this file for loading animation --}}
    <link rel="stylesheet" href="{{ asset('css/mySass/loading/loading.css') }}">
        {{-- this for login and register --}}
    <link rel="stylesheet" href="{{ asset('css/mySass/style.css') }}">

    <link rel="stylesheet" href="{{ asset('css/mySass/homePage.css') }}">

    {{-- this for message --}}
    <link rel="stylesheet" href="{{ asset('css/mySass/messages/style.css') }}">

    {{-- this link for window send and recive mesage --}}
    <link rel="stylesheet" href="{{ asset('css/mySass/my_you/my_you.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">




    <title>ChatApp</title>
</head>

<body>

    {{-- app root --}}
    <div class="" id="app" style="
        height: 100vh;
        margin: auto;
        display: flex;
        justify-content: center;
        width: 100%;
    ">
        <!-- loading animation  -->
        <main v-if="loading">
            <div class="loadingstyle">
                <div class="preloader">
                    <div class="preloader__square"></div>
                    <div class="preloader__square"></div>
                    <div class="preloader__square"></div>
                    <div class="preloader__square"></div>
                </div>
                <div class="status">Loading<span class="status__dot">.</span><span class="status__dot">.</span><span
                        class="status__dot">.</span></div>
            </div>
        </main>
        <!-- //loading animation  -->
        {{-- navbar --}}
        <nav>
            <div class="wepper">
                <div class="logo">
                    <router-link to="/">ChatApp</router-link>
                </div>
                <li class="search-buuton">
                    <div v-if="isSearching == false">
                        <i class="far fa-search search-icon" @click="showInputSearch"></i>
                    </div>
                    {{-- <div v-else>
                        <img class="search-icon search-animation"
                            src="{{ asset('media/searchAnimation/search.svg') }}" alt="">
                    </div> --}}
                    <input type="search" placeholder="search ..." v-model="searchUser">
                </li>
                <ul class="main-list">

                    <li class="num-messages">
                        <router-link to="/messages-users">
                            <i class="far fa-envelope"></i>
                            <span>20</span>
                        </router-link>
                    </li>

                    <li v-if="users" class="showList">
                        <div class="show-list-setting-profile" @click="showList">
                            <i class="far fa-user-alt"></i>
                            <p v-text="users.data.username"></p>
                        </div>

                        <ul class="profile-list">
                            <li>
                                <div class="logout"><button @click.prevent="logout">Logout</button></div>
                            </li>
                            <li>
                                <div class="update"><a href="">Update</a></div>
                            </li>
                        </ul>
                    </li>
                    <li v-else class="showList">

                        <div class="show-login">
                            <router-link to="/login" custom> Login</router-link>
                        </div>
                        <div class="show-signup">
                            <router-link to="/signup" custom>Signup</router-link>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <div v-text="homeRedirect"></div>
        <div v-text="loginRedirect"></div>
        <div v-text="hideNavBar"></div>
        {{-- /navbar --}}


        {{-- global-home --}}
        <global-home></global-home>
        {{-- global-home --}}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>

    {{-- this for file for login and register --}}
    <script src="{{ asset('js/myJs/main.js') }}"></script>

    {{-- /app root --}}
    <script src="../js/app.js"></script>


</body>

</html>
