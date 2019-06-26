<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

/**
 * @property int $id
 * @property int $provider_id
 * @property string $name
 * @property int $game_type
 * @property int $device_type
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property GameProvider $provider
 * @property GameStat[] $stats
 */
class Game extends Model
{
    use Sortable;

    /**
     * @var array
     */
    public $sortable = ['id', 'name', 'created_at'];

    /**
     * @var array
     */
    public $sortableAs = [
        'stats_count'
    ];

    /**
     * @var array
     */
    protected $fillable = ['provider_id', 'name', 'game_type', 'device_type', 'status', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provider()
    {
        return $this->belongsTo(GameProvider::class, 'provider_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stats()
    {
        return $this->hasMany(GameStat::class);
    }
}
