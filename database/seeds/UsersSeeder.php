<?php

use App\Models\User\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * @var Generator
     */
    protected $faker;

    public function __construct()
    {
        $this->faker = Factory::create('ru_RU');
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersData = [
            [
                'id'                => 1,
                'name'              => $this->faker->firstName,
                'email'             => 'user1@test.com',
                'password'          => Hash::make('123456'),
                'created_at'        => \Carbon\Carbon::now(),
                'updated_at'        => \Carbon\Carbon::now()
            ],
            [
                'id'                => 2,
                'name'              => $this->faker->firstName,
                'email'             => 'user2@test.com',
                'password'          => Hash::make('123456'),
                'created_at'        => \Carbon\Carbon::now(),
                'updated_at'        => \Carbon\Carbon::now()
            ],
        ];

        User::query()->insert($usersData);
    }
}
