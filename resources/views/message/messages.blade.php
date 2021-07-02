<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/mySass/messages/style.css') }}" />
    <title>The Messages</title>
</head>

<body>
    <div class="container">
        <div class="wepper">
            <!-- my icon -->
            <div class="my-icon">
                <!-- left side -->
                <div class="left-side">
                    <i class="fas fa-arrow-left"></i>
                    <div>
                        <img src="https://via.placeholder.com/150" alt="" />
                        <div class="nick-name">
                            <p>user name</p>
                            <p>Active Now <span></span></p>
                        </div>
                    </div>
                </div>
                <!-- //left side -->
                <!-- right side -->
                <div class="hours">22:55 PM</div>
                <!-- //right side -->
            </div>
            <!-- //my icon -->

            <!-- liist user -->
            <div class="list-users">
                @foreach ($sndUsr as $user)
                    @if ($user->id != auth()->user()->id)
                        <!-- card -->
                        <a href="{{route('user.message',$user->username)}}" >
                            <div class="card">
                                <div class="icon-user">
                                    <img src="{{$user->img}}" alt="">
                                    <div>
                                        <p class="username">
                                            {{$user->username}}
                                        </p>
                                        @if ($user->messages->reverse()->first()->state==1)
                                        <p class="last-message" style="color:rgb(134, 132, 132) ">
                                            {{$user->messages->reverse()->first()->content}}
                                         </p>
                                         @else
                                         <p class="last-message">
                                            {{$user->messages->reverse()->first()->content}}
                                         </p>
                                        @endif


                                    </div>
                                </div>
                                <div class="state-user">
                                    <span></span>
                                </div>
                            </div>
                        </a>

                        <!-- //card -->
                    @endif
                @endforeach

            </div>
            <!-- //list user -->
        </div>
    </div>
</body>

</html>
