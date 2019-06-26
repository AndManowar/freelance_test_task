<?php
/**
 * Created by PhpStorm.
 * User: hellenmicky
 * Date: 26.06.2019
 * Time: 09:56
 */

namespace App\Serivces\Game;

use App\Repositories\Game\GameRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class GameService
 * @package App\Serivces\Game
 */
class GameService
{
    /**
     * @var GameRepository
     */
    protected $gameRepository;

    /**
     * GameService constructor.
     * @param GameRepository $gameRepository
     */
    public function __construct(GameRepository $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    /**
     * @param array $search
     * @param int $pageSize
     * @return LengthAwarePaginator
     */
    public function getGames(array $search = [], int $pageSize = 15): LengthAwarePaginator
    {
        return $this->gameRepository->getGames($search, $pageSize);
    }
}