<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Position;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for($i = 1; $i <= 50; $i++){

            $department = new Position();
            $department->job_position_name = $faker->jobTitle;
            $department->description = $faker->randomLetter;
            $department->department_id = Department::query()->inRandomOrder()->first();
            $department->save();

        }
    }
}
