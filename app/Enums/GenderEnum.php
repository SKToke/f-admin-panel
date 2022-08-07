<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;

/**
 * Class GenderEnum
 * @package App\Enums
 *
 * @method static self male()
 * @method static self female()
 * @method static self lgbt()
 */
final class GenderEnum extends Enum
{
    /**
     * @return int[]
     */
    #[ArrayShape([
        'male' => 'string',
        'female' => 'string',
        'lgbt' => 'string',
    ])] protected static function values(): array
    {
        return [
            'male' => 'male',
            'female' => 'female',
            'LGBT+' => 'LGBT+'
        ];
    }

    /**
     * @return array
     */
    #[ArrayShape([
        'male' => 'string',
        'female' => 'string',
        'lgbt' => 'string',
    ])] protected static function labels(): array
    {
        return [
            'male' => __('enums.gender.male'),
            'female' => __('enums.gender.female'),
            'lgbt' => __('enums.gender.lgbt'),
        ];
    }
}
