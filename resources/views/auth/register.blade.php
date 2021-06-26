<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/mySass/style.css') }}">
    <style>
    </style>
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
                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <input type="text" name="username" placeholder="username" value="{{old('username')}}" required id="">
                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <input type="email" name="email" placeholder="email" value="{{old('email')}}" required id="">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    {{-- <label for="file" style="text-align: left;font-size: 11px;line-height: 30px;">chose your
                        image</label>
                    <input type="file" name="image" id="file">
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror --}}
                    <input type="password" name="password" placeholder="password" required id="">
                    <input type="password" name="password_confirmation" placeholder="password confirm" required id="">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <button type="submit">Sign Up</button>
                </form>
                <!-- form -->
            </div>
            <!-- login -->
        </div>
        <!-- /wepper -->
    </div>
    <!-- /container -->
    <script src="{{ asset('js/myJs/main.js') }}"></script>
</body>

</html>
