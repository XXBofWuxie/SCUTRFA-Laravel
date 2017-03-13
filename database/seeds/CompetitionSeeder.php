<?php

use Illuminate\Database\Seeder;
use App\CompetitionTeam;

class CompetitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\CompetitionTeam::class, 20)->create()->each(function(CompetitionTeam $team) {
            $team->competitionMember()->save(factory(App\CompetitionMember::class)->make([
                'is_leader' => true,
            ]));
            $team->competitionMember()->save(factory(App\CompetitionMember::class)->make([
                'is_leader' => false,
            ]));
            $team->competitionMember()->save(factory(App\CompetitionMember::class)->make([
                'is_leader' => false,
            ]));
        });
    }
}
