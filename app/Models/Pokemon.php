<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pokemon extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'pokeapi_id',
        'base_experience',
        'height',
        'is_default',
        'stats',
        'order',
        'weight',
        'cry',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'stats' => 'json',
            'is_default' => 'bool',
        ];
    }

    /**
     * @return BelongsToMany<PokemonAbility>
     */
    public function abilities(): BelongsToMany
    {
        return $this->belongsToMany(PokemonAbility::class)->withPivot('is_hidden', 'slot');
    }

    /**
     * @return BelongsToMany<PokemonForm>
     */
    public function forms(): BelongsToMany
    {
        return $this->belongsToMany(PokemonForm::class)->orderBy('order');
    }

    /**
     * @return Builder<Pokemon>
     */
    public function scopeWithRelations(): Builder
    {
        return Pokemon::query()->with(static::eagerLoadedRelationships());
    }

    /**
     * @return array<int,string>
     */
    public static function eagerLoadedRelationships(): array
    {
        return [
            'abilities:id,name',
            'forms:id,name,order,form_order,is_battle_only,is_default,is_mega,sprites',
        ];
    }

    public function eagerLoaded(): static
    {
        return tap($this)->load(static::eagerLoadedRelationships());
    }
}
