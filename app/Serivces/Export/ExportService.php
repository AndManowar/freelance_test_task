<?php
/**
 * Created by PhpStorm.
 * User: hellenmicky
 * Date: 26.06.2019
 * Time: 10:51
 */

namespace App\Serivces\Export;

use App\Repositories\Game\GameRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use League\Csv\CannotInsertRecord;
use League\Csv\Writer;

/**
 * Class ExportService
 * @package App\Serivces\Export
 */
class ExportService
{
    /**
     * @var Writer
     */
    protected $writer;

    /**
     * @var GameRepository
     */
    protected $gameRepository;

    /**
     * ExportService constructor.
     * @param GameRepository $gameRepository
     */
    public function __construct(GameRepository $gameRepository)
    {
        $this->writer = Writer::createFromString('');
        $this->gameRepository = $gameRepository;
    }

    /**
     * @param array $search
     * @return int
     * @throws CannotInsertRecord
     */
    public function getGamesDataAsCsv(array $search = [])
    {
        $headers = ['id', 'name', 'provider_id', 'provider_name', 'game_type', 'device_type', 'status', 'created_at', 'stats_count'];

        $data = $this->gameRepository->getGames($search, 15, true)
            ->select(
                'games.id',
                'games.name',
                'provider_id',
                'game_providers.name as provider_name',
                'game_type',
                'device_type',
                'status',
                'games.created_at',
                DB::raw('COUNT(game_stats.id) as stats_count')
            )
            ->join('game_stats', 'game_stats.game_id', '=', 'games.id')
            ->join('game_providers', 'games.provider_id', '=', 'game_providers.id')
            ->groupBy('games.id')
            ->get()
            ->toArray();

        $this->writer->insertOne($headers);

        $this->writer->insertAll($data);

        return $this->writer->output(Str::random(15) . '.csv');
    }
}