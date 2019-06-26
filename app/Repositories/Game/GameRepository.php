<?php
/**
 * Created by PhpStorm.
 * User: hellenmicky
 * Date: 26.06.2019
 * Time: 09:57
 */

namespace App\Repositories\Game;

use App\Models\Game\Game;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class GameRepository
 * @package App\Repositories\Game
 */
class GameRepository
{
    /**
     * @param array $search
     * @param int $pageSize
     * @param bool $isForExport
     * @return LengthAwarePaginator|Builder
     */
    public function getGames(array $search = [], int $pageSize = 15, bool $isForExport = false)
    {
        $query = Game::sortable()->withCount('stats');

        if (isset($search['id'])) {
            $query->where('games.id', $search['id']);
        }

        if (isset($search['name'])) {
            $query->where('games.name', 'like', "%{$search['name']}%");
        }

        if (isset($search['date_from'])) {
            $query->where('games.created_at', '>=', $search['date_from']);
        }

        if (isset($search['date_to'])) {
            $query->where('games.created_at', '<=', $search['date_to']);
        }

        if (!$isForExport) {
            return $query->with('provider')->paginate($pageSize);
        }

        return $query;
    }
}