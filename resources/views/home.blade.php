<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/mySass/homePage.css') }}">
    <title>ChatApp</title>
</head>

<body>

    {{-- app root --}}
    <div class="" id="app">
        {{-- navbar --}}
        <nav>
            <div class="wepper">
                <div class="logo">
                    <a href="">ChatApp</a>
                </div>
                <ul class="main-list">
                    <li class="search-buuton" >
                        <i class="far fa-search search-icon" @click="showInputSearch"></i>
                        <input type="search">
                    </li>

                    <li class="num-messages">
                        <a href="">
                            <i class="far fa-envelope"></i>
                            <span>20</span>
                        </a>
                    </li>

                    <li class="showList">
                        <div class="show-list-setting-profile" @click="showList">
                            <i class="far fa-user-alt"></i> User
                        </div>
                        <ul class="profile-list">
                            <li>
                                <div class="logout"><a href="">Logout</a></div>
                            </li>
                            <li>
                                <div class="update"><a href="">Update</a></div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        {{-- /navbar --}}



        {{-- global-home --}}
        <global-home></global-home>
        {{-- global-home --}}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    {{-- /app root --}}
    <script src="../js/app.js"></script>
</body>

</html>
