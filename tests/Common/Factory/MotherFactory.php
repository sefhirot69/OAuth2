<?php

declare(strict_types=1);

namespace App\Tests\Common\Factory;

use Faker\Factory;
use Faker\Generator;

final class MotherFactory
{
    private static ?Generator $faker;

    public static function random(): Generator
    {
        return self::$faker = self::$faker ?? Factory::create();
    }
}
