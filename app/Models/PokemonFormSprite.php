<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PokemonFormSprite extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * @return HasOne<PokemonForm>
     */
    public function form(): HasOne
    {
        return $this->hasOne(PokemonForm::class);
    }
}
