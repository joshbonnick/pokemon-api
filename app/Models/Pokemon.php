<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pokemon extends Model
{
    use HasFactory;

    /**
     * @return BelongsToMany<PokemonAbility>
     */
    public function abilities(): BelongsToMany
    {
        return $this->belongsToMany(PokemonAbility::class);
    }

    /**
     * @return BelongsToMany<PokemonForm>
     */
    public function forms(): BelongsToMany
    {
        return $this->belongsToMany(PokemonForm::class);
    }

    /**
     * @return BelongsToMany<PokemonHeldItem>
     */
    public function held_items(): BelongsToMany
    {
        return $this->belongsToMany(PokemonHeldItem::class);
    }
}
