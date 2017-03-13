<?php
use Illuminate\Database\Seeder;
use App\Health;

class HealthSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Health::class, 8)->create();
    }
}
