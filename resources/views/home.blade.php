<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/mySass/homePage.css') }}">
    <title>ChatApp</title>
</head>

<body>

    {{-- app root --}}
    <div class="" id="app">
        <nav>
            <div class="wepper">
                <div class="logo">
                    <a href="">ChatApp</a>
                </div>
                <ul class="main-list">
                    <li>
                        <a href="">
                            <i class="far fa-envelope"></i>
                            <span>20</span>
                        </a>
                    </li>

                    <li>
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
        <global-home></global-home>
    </div>

    {{-- /app root --}}
    <script src="../js/app.js"></script>
</body>

</html>
