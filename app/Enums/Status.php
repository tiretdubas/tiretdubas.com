<?php

namespace App\Enums;

enum Status: string
{
    case Draft = 'gray';
    case Published = 'success';
    case Archived = 'warning';

    /**
     * @return array<int, string>
     */
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    /**
     * @return array<string, string>
     */
    public static function arrayWithTranslations(): array
    {
        return array_combine(
            self::names(),
            collect(self::names())->map(fn ($name): string => __("Status.$name"))->toArray()
        );
    }

    public static function color(string $state): string
    {
        return constant("self::$state")->value;
    }
}
