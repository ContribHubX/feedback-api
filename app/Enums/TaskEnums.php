<?php
namespace App\Enums;

class TaskEnums
{
    public const LOW = 'low';
    public const MEDIUM = 'medium';
    public const HIGH = 'high';

    public static function get() : array
    {
        return [
            self::LOW,
            self::MEDIUM,
            self::HIGH
        ];
    }
}
