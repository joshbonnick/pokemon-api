<?php

namespace App\Enums;

enum PokemonStats: string
{
    case HP = 'hp';
    case SPEED = 'speed';
    case ATTACK = 'attack';
    case DEFENSE = 'defense';
    case SPECIAL_ATTACK = 'special_attack';
    case SPECIAL_DEFENSE = 'special_defense';

    /**
     * @return array<string, string>
     */
    public static function labels(): array
    {
        return collect(self::cases())->mapWithKeys(fn (self $enum) => [
            $enum->value => match ($enum) {
                self::HP => 'HP',
                self::SPECIAL_ATTACK => 'Special Attack',
                self::SPECIAL_DEFENSE => 'Special Defense',
                default => ucfirst($enum->value)
            },
        ])->toArray();
    }
}
