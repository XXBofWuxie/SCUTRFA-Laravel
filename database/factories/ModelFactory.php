<?php 
$factory->define(App\Activity::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->word,
        'abstract' => $faker->word,
        'schedule' => $faker->text,
        'sign_up_url' => $faker->word,
    ];
});

$factory->define(App\CompetitionMember::class, function (Faker\Generator $faker) {
    return [
        'team_id' => $faker->randomNumber(),
        'is_leader' => $faker->boolean,
        'name' => $faker->name,
        'phone' => $faker->phoneNumber,
        'qq' => $faker->word,
    ];
});

$factory->define(App\CompetitionTeam::class, function (Faker\Generator $faker) {
    return [
        'team_name' => $faker->word,
        'slogen' => $faker->word,
    ];
});

foreach (range(0, 119) as $value) {
    $health_data[$value] = rand(110, 150);
}
$factory->define(App\Health::class, function (Faker\Generator $faker) use($health_data) {
    return [
        'data_type' => rand(1, 2),
        'create_time' => $faker->randomNumber(),
        'data_time' => $faker->randomNumber(),
        'data' => serialize($health_data),
    ];
});

