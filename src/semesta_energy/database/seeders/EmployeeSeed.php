<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $religion = ['islam', 'kristen', 'protestan', 'hindu', 'budha', 'lainnya'];
        $gender = ['male','female'];
        for ($i = 1; $i <= 50; $i++) {

            $employee = new Employee();
            $employee->name = $faker->name;
            $employee->id_card = $faker->creditCardNumber;
            $employee->gender = array_rand($gender);
            $employee->religion = array_rand($religion);
            $employee->photo = $faker->imageUrl;
            $employee->address = $faker->address;
            $employee->handphone = $faker->phoneNumber;
            $employee->job_position_id = Position::query()->inRandomOrder()->first()->id;

        }
    }
}
