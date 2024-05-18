<?php

namespace App\Enums;

enum PokemonStats: string
{
    case HP = 'hp';
    case SPEED = 'speed';
    case ATTACK = 'attack';
    case DEFENSE = 'defense';

    /**
     * @return array<string, string>
     */
    public static function labels(): array
    {
        return collect(self::cases())->mapWithKeys(fn (self $enum) => [
            $enum->value => match ($enum) {
                self::HP => 'HP',
                default => ucfirst($enum->value)
            },
        ])->toArray();
    }
}
