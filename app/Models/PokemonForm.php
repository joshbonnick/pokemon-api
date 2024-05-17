<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PokemonForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'pokeapi_id',
        'name',
        'order',
        'form_order',
        'is_battle_only',
        'is_default',
        'is_mega',
        'sprites',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_default' => 'bool',
            'is_battle_only' => 'bool',
            'is_mega' => 'bool',
            'sprites' => 'json',
        ];
    }

    /**
     * @return BelongsToMany<Pokemon>
     */
    public function pokemon(): BelongsToMany
    {
        return $this->belongsToMany(Pokemon::class);
    }
}
