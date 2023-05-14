<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            'umbara' => 'User',
            'Doni' => 'Admin'
        ];
        $faker = Faker::create();
        foreach ($users as $key => $user) {
            $store = User::query()->where('username', $key)->firstOrNew();
            $store->name = $key;
            $store->username = $key;
            $store->email = $faker->email;
            $store->password = Hash::make(12345);
            $store->save();

            $store->assignRole($user);

        }
    }
}
