<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;

/**
 * Class Event Enum
 * @package App\Enums
 *
 * @method static self on_going()
 * @method static self completed()
 * @method static self canceled()
 */
final class EventStatusEnum extends Enum
{
    /**
     * @return int[]
     */
    #[ArrayShape([
        'on_going' => 'int',
        'completed' => 'int',
        'canceled' => 'int',
    ])] protected static function values(): array
    {
        return [
            'on_going' => 1,
            'completed' => 2,
            'canceled' => 0
        ];
    }

    /**
     * @return array
     */
    #[ArrayShape([
        'on_going' => 'string',
        'completed' => 'string',
        'canceled' => 'string',
    ])] protected static function labels(): array
    {
        return [
            'on_going' => __('enums.event.on-going'),
            'completed' => __('enums.gender.completed'),
            'canceled' => __('enums.gender.canceled'),
        ];
    }
}
