<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{asset('./css/mySass/style.css')}}">
    <title>Login</title>
</head>

<body>
    <!-- container -->
    <div class="container">
        <!-- wepper -->
        <div class="wepper">
            <!-- login -->
            <div class="login">
                <!-- form -->
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <input type="text" name="varible" placeholder="email or username" value="{{ old('varible') }}"
                        required id="">
                    @error('varible')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <input type="password" name="password" placeholder="password" required id="">
                    <i class="far fa-eye"></i>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <button class="button-form" type="submit">Login</button>
                </form>
                <!-- form -->
            </div>
            <!-- login -->
        </div>
        <!-- /wepper -->
    </div>
    <!-- /container -->
    <script src="{{asset('./js/myJs/main.js')}}"></script>
</body>

</html>
