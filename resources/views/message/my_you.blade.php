@extends('layouts.base')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/mySass/my_you/style.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('title')
    {{ $usr_id->username }}
@stop
@section('body')
    <div class="background_image">
        <img src="{{ asset('media/1.jpg') }}" alt="" />
    </div>
    <!-- consignee -->
    <div class="consignee">
        <!-- contente-users -->
        <div class="contente-users">
            <i class="fas fa-arrow-left"></i>
            <div>
                <img src="{{ $usr_id->img }}" alt="" />
                <div>
                    <p>{{ $usr_id->username }}</p>
                </div>
            </div>
        </div>
        <!-- contente-users -->
        <!-- body of message -->
        <div class="message-cover">
            @foreach ($all_msg as $msgs)
                @foreach ($msgs as $msg)
                    <input type="hidden" name="msg" value="{{ $msg }}">
                @endforeach
            @endforeach

        </div>
        <!-- //body of message -->

        <!-- form message -->
        <div class="form-message">
            <form id="data">
                @csrf
                <input type="hidden" name="sendUsr" value="{{ auth()->user()->id }}">
                <input type="hidden" name="reciveUsr" value="{{ $usr_id->id }}">
                <input type="text" name="message" placeholder="your message ...">
                <button id="send"><i class="fas fa-paper-plane"></i></button>
            </form>
        </div>
        <!-- //form message -->
    </div>
    <!-- //consignee -->
@stop

@section('script')
    <script>
        localStorage.setItem('sndUsr', "{{ auth()->user()->id }}");
        localStorage.setItem('rcvUsr', "{{ $usr_id->id }}");
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/myJs/jQuery.min.js') }}"></script>
    <script src="{{ asset('js/myJs/sendMessage.js') }}"></script>

    <script>
        var jsn = '';
        var obj2 = [];
        var usrId = parseInt("{{ auth()->user()->id }}");
        var recivephoto = "{{ $usr_id->img }}"
        var obj = document.querySelectorAll('input[name=msg]')

        //convert string to json
        for (i = 0; i < obj.length; i++) {
            jsn = JSON.parse(obj[i].value);
            obj2[i] = jsn;
            jsn = '';
        } //end of for i
        //end convert to string


        //sort object
        newobj = obj2.sort(function(a, b) {
            return new Date(a.created_at) - new Date(b.created_at);
        })
        //end of sort

        //give the messages to html code
        var bdy = document.body;
        for (var i = 0; i < newobj.length; i++) {
            if (obj2[i].user_id == usrId) {
                var myMessage = document.createElement('div');
                myMessage.classList = 'my-message';

                var createP = document.createElement('p');
                createP.textContent = newobj[i].content;
                myMessage.appendChild(createP);

                var messageCover = document.getElementsByClassName('message-cover')[0];
                messageCover.appendChild(myMessage);
            } else {
                var yourMessage = document.createElement('div');
                yourMessage.classList = 'your-message';
                var youPhoto = document.createElement('div');
                youPhoto.classList = 'your-photo';
                var photo = document.createElement('img')
                photo.src = recivephoto;
                youPhoto.appendChild(photo)
                yourMessage.appendChild(youPhoto);

                var contentMessage = document.createElement('div');
                contentMessage.classList = 'content-your-message';
                var createP = document.createElement('p');
                createP.textContent = newobj[i].content;
                contentMessage.appendChild(createP);

                var messageCover = document.getElementsByClassName('message-cover')[0];
                messageCover.appendChild(yourMessage);
                yourMessage.appendChild(contentMessage)
                messageCover.appendChild(yourMessage);

            } //end of if
        } //end of for i

        //end give the messages to html code
    </script>

    <script>
        //make scrollbar in bottom

        var messageCover = document.getElementsByClassName('message-cover')[0];
        messageCover.scrollTop = messageCover.scrollHeight;

        //end make scrollbar in bottom
    </script>


@stop
