<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = Team::factory(20)->create();

        $teams->each(function ($team) {
            $team->users()->attach(User::inRandomOrder()->first()->id);
        });
    }
}
