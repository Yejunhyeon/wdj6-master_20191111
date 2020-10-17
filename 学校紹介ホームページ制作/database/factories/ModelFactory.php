<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

//게시글 팩토리
$factory->define(App\Article::class, function (Faker $faker) {
    $date = $faker->dateTimeThisMonth;
    $userId = App\User::pluck('id')->toArray();
    return [
        'user_id' => $faker->randomElement($userId),
        'title' => $faker->sentence(),
        'content' => $faker->paragraph(),
        'created_at' => $date,
        'updated_at' => $date,
    ];
});

//프로그램 팩토리
$factory->define(App\Program::class, function (Faker $faker) {
    $date = $faker->dateTimeThisMonth;
    $userId = App\User::pluck('id')->toArray();
    return [
        'user_id' => $faker->randomElement($userId),
        'title' => $faker->sentence(),
        'content' => $faker->paragraph(),
        'created_at' => $date,
        'updated_at' => $date,
    ];
});

//첨부파일 팩토리
$factory->define(App\Attachment::class, function (Faker $faker) {
    return [
        'filename' => sprintf("%s.%s",
            Str::random(),
            $faker->randomElement(config('project.mimes'))
        ),
    ];
});

//프로그램 첨부파일 팩토리
$factory->define(App\Program_attachment::class, function (Faker $faker) {
    return [
        'filename' => sprintf("%s.%s",
            Str::random(),
            $faker->randomElement(config('project.mimes'))
        ),
    ];
});

//댓글 팩토리
$factory->define(App\Comment::class, function (Faker $faker) {
    $articleIds = App\Article::pluck('id')->toArray();
    $userIds = App\User::pluck('id')->toArray();
    return [
        'content' => $faker->paragraph,
        'commentable_type' => App\Article::class,
        'commentable_id' => function () use ($faker, $articleIds) {
            return $faker->randomElement($articleIds);
        },
        'user_id' => function () use ($faker, $userIds) {
            return $faker->randomElement($userIds);
        },
    ];
});

//투표 팩토리
$factory->define(App\Vote::class, function (Faker $faker) {
    $up = $faker->randomElement([true, false]);
    $down = ! $up;
    $userIds = App\User::pluck('id')->toArray();
    return [
        'up' => $up ? 1 : 0,
        'down' => $down ? 1 : 0,
        'user_id' => function () use($faker, $userIds) {
            return $faker->randomElement($userIds);
        },
    ];
});