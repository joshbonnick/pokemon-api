<?php

namespace App\Enums;

enum PokemonStats: string
{
    case HP = 'hp';
    case SPEED = 'speed';
    case ATTACK = 'attack';
    case DEFENSE = 'defense';
    case SPECIAL_ATTACK = 'special-attack';
    case SPECIAL_DEFENSE = 'special-defense';

    /**
     * @return array<string, string>
     */
    public static function labels(): array
    {
        return collect(self::cases())->mapWithKeys(function (self $value) {
            return [
                $value->value => match ($value) {
                    self::HP => 'HP',
                    self::SPECIAL_ATTACK => 'Special Attack',
                    self::SPECIAL_DEFENSE => 'Special Defense',
                    default => ucfirst($value->value)
                },
            ];
        })->toArray();
    }
}
