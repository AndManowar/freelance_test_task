<?php

use App\Models\Game\Game;
use App\Models\Game\GameProvider;
use App\Models\Game\GameStat;
use Illuminate\Database\Seeder;

/**
 * Class GamesDataSeeder
 */
class GamesDataSeeder extends Seeder
{
    /**
     * @var Generator
     */
    protected $faker;

    /**
     * GamesDataSeeder constructor.
     */
    public function __construct()
    {
        $this->faker = \Faker\Factory::create('ru_RU');
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gameProvidersData = [];
        $gamesData = [];
        $statsData = [];

        for ($i = 0; $i < 10; $i++) {
            /**
             * @var array
             */
            $gameProvidersData [] = [
                'name'       => $this->faker->text(30),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ];
        }

        GameProvider::query()->insert($gameProvidersData);

        $providerIds = GameProvider::query()->pluck('id')->toArray();

        for ($i = 1; $i < 50; $i++) {
            $gamesData [] = [
                'id'          => $i,
                'provider_id' => $providerIds[rand(0, count($providerIds) - 1)],
                'name'        => $this->faker->text(20),
                'game_type'   => 0,
                'device_type' => 1,
                'status'      => 1,
                'created_at'  => \Carbon\Carbon::createFromTimestamp($this->faker->unixTime),
                'updated_at'  => \Carbon\Carbon::createFromTimestamp($this->faker->unixTime)
            ];

            for ($j = 0; $j < rand(1, 20); $j++) {
                $statsData [] = [
                    'user_id'         => rand(1, 2),
                    'game_id'         => $i,
                    'bet'             => rand(1, 20000),
                    'win'             => rand(0, 10000),
                    'currency'        => 'USD',
                    'balance_before'  => rand(1, 202000),
                    'balance_after'   => rand(1, 220000),
                    'win_combination' => '[0,1,2,3,4,5]',
                    'date'            => $this->faker->dateTime,
                    'created_at'      => \Carbon\Carbon::createFromTimestamp($this->faker->unixTime),
                    'updated_at'      => \Carbon\Carbon::createFromTimestamp($this->faker->unixTime)
                ];
            }
        }

        Game::query()->insert($gamesData);
        GameStat::query()->insert($statsData);

    }
}
