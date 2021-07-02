<?php

use App\Message;
use App\User;
use Illuminate\Database\Seeder;

class CreateUserSedder extends Seeder
{

    public function run()
    {
        User::create([
            'username'=>'user1',
            'email'=>'user1@gmail.com',
            'password'=>bcrypt('12341234qw')
        ]);
        User::create([
            'username'=>'user2',
            'email'=>'user2@gmail.com',
            'password'=>bcrypt('12341234qw')
        ]);
        User::create([
            'username'=>'user3',
            'email'=>'user3@gmail.com',
            'password'=>bcrypt('12341234qw')
        ]);
        Message::create([
           'user_id'=>2,
           'content'=>'message from 2 to 1'
        ]);
        Message::create([
            'user_id'=>3,
            'content'=>'message from 3 to 1'
         ]);
         Message::create([
            'user_id'=>2,
            'content'=>'message from 2 to 3'
         ]);
    }
}
