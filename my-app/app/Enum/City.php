<?php

namespace App\Enum;

enum City: string {
    case Tokyo = 'Tokyo';
    case Osaka = 'Osaka';
    case Sapporo = 'Sapporo';
    case Nagoya = 'Nagoya';
    case Fukuoka = 'Fukuoka';
    case Naha = 'Naha';

    public function getLocation(): array {
        return match ($this) {
            self::Tokyo => ['latitude' => 35.6895, 'longitude' => 139.6917],
            self::Osaka => ['latitude' => 34.6937, 'longitude' => 135.5023],
            self::Sapporo => ['latitude' => 43.0618, 'longitude' => 141.3545],
            self::Nagoya => ['latitude' => 35.1815, 'longitude' => 136.9066],
            self::Fukuoka => ['latitude' => 33.5904, 'longitude' => 130.4017],
            self::Naha => ['latitude' => 26.2124, 'longitude' => 127.6809],
        };
    }

    public function getKanjiName(): string {
        return match ($this) {
            self::Tokyo => '東京',
            self::Osaka => '大阪',
            self::Sapporo => '札幌',
            self::Nagoya => '名古屋',
            self::Fukuoka => '福岡',
            self::Naha => '那覇',
        };
    }

    public static function getAllCities(): array {
        return array_map(fn($city) => [
            'english_name' => $city->value,
            'kanji_name' => $city->getKanjiName(),
        ], City::cases());
    }
}
