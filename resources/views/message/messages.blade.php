@extends('layouts.base')

@section('style')
<link rel="stylesheet" href="{{ asset('css/mySass/messages/style.css') }}" />
@stop
@section('title')
The Messages
@stop
@section('body')
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
                                 <input type="hidden" name="state" value="1">
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
@stop
