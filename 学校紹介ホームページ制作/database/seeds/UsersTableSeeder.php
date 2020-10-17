<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()   //시더가 실행되면 작동할 코드 작성
    {
        App\User::create([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('secret'),// password
            'remember_token' => Str::random(10),
            'activated' => 1,
        ]);

        $name = ["이재영", "장준혁", "김도형", "팽진솔", "예준현", "정인식"];
        $email = [
            "dl@wodud",
            "wkd@wnsgur",
            "rla@ehgud",
            "vod@wlsthf",
            "dP@wnsgus",
            "wjd@dlstlr"
        ];
        
        for($i = 0; $i < 6; $i++){
            App\User::create(
                [
                    'name' => $name[$i],
                    'email' => $email[$i],
                    'email_verified_at' => now(),
                    'password' => bcrypt('password'),
                    'remember_token' => Str::random(10),
                    'activated' => 1,
                ]
            );
        }
        
    }
}