<?php

namespace App\Models\Game;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $game_id
 * @property int $bet
 * @property int $win
 * @property string $currency
 * @property int $balance_before
 * @property int $balance_after
 * @property string $date
 * @property string $win_combination
 * @property string $created_at
 * @property string $updated_at
 * @property Game $game
 * @property User $user
 */
class GameStat extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'game_id', 'bet', 'win', 'currency', 'balance_before', 'balance_after', 'date', 'win_combination', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
