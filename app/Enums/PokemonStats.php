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
}
