<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 * @property Game[] $games
 */
class GameProvider extends Model
{
    /**
     * @var array
     */
    public $sortable = ['name'];

    /**
     * @var array
     */
    protected $fillable = ['name', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function games()
    {
        return $this->hasMany(Game::class, 'provider_id');
    }
}
