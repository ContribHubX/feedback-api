<?php
namespace App\Enums;

enum RatingEnums : int
{
    case AWFUL = 1;
    case POOR = 2;
    case NEUTRAL = 3;
    case GOOD = 4;
    case EXCELLENT = 5;

    public static function values(): array
    {
        return array_column(RatingEnums::cases(), 'value');
    }
}
