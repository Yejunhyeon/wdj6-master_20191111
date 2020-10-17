<?php

use Illuminate\Database\Seeder;

class membersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = ["이재영", "장준혁", "김도형", "팽진솔", "예준현", "정인식"];
        $comments = [
            "dl@wodud",
            "wkd@wnsgur",
            "rla@ehgud",
            "vod@wlsthf",
            "dP@wnsgus",
            "wjd@dlstlr"
        ];
        $filename = [
            "default.png",
            "default2.png",
            "default3.png",
            "default4.png",
            "default5.png",
            "default6.png",
        ];
        for($i = 0; $i < 6; $i++){
            \App\Member::create(
                [
                    'name' => $name[$i],
                    'comments' => $comments[$i],
                    'filename' => $filename[$i],
                ]
            );
        }
    }
}
