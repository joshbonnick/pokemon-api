<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PokemonForm extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_default' => 'bool',
            'is_battle_only' => 'bool',
            'is_mega' => 'bool',
        ];
    }

    /**
     * @return BelongsToMany<Pokemon>
     */
    public function pokemon(): BelongsToMany
    {
        return $this->belongsToMany(Pokemon::class);
    }

    /**
     * @return BelongsTo<PokemonFormSprite, PokemonForm>
     */
    public function sprite(): BelongsTo
    {
        return $this->belongsTo(PokemonFormSprite::class, 'pokemon_form_sprite_id');
    }
}
