<?php

namespace Database\Seeders;

use App\Models\Extra;
use Illuminate\Database\Seeder;

class ExtraSeeder extends Seeder
{
    public function run(): void
    {
        $extras = [
            [
                'key' => 'full_fuel',
                'icon' => 'ti-gas-station',
                'price' => 15000,
                'pricing_type' => 'flat',
                'sort_order' => 1,
                'name' => [
                    'hy' => 'Ամբողջական վառելիք',
                    'ru' => 'Полный бак',
                    'en' => 'Full Fuel Option',
                ],
                'description' => [
                    'hy' => 'Մեքենան վերադարձրեք առանց վառելիքը լրացնելու հոգսի',
                    'ru' => 'Верните машину без хлопот по заправке',
                    'en' => 'Return the car without worrying about refilling',
                ],
            ],
            [
                'key' => 'additional_driver',
                'icon' => 'ti-user-plus',
                'price' => 2000,
                'pricing_type' => 'per_day',
                'sort_order' => 2,
                'name' => [
                    'hy' => 'Լրացուցիչ վարորդ',
                    'ru' => 'Дополнительный водитель',
                    'en' => 'Additional Driver',
                ],
                'description' => [
                    'hy' => 'Ավելացրեք երկրորդ վարորդի անունը պայմանագրում',
                    'ru' => 'Добавьте второго водителя в договор',
                    'en' => 'Add a second driver to the contract',
                ],
            ],
            [
                'key' => 'child_seat',
                'icon' => 'ti-car-suv',
                'price' => 1500,
                'pricing_type' => 'per_day',
                'sort_order' => 3,
                'name' => [
                    'hy' => 'Մանկական նստատեղ',
                    'ru' => 'Детское кресло',
                    'en' => 'Child Seat',
                ],
                'description' => [
                    'hy' => 'ISOFIX մանկական նստատեղ 0-4 տարեկան երեխաների համար',
                    'ru' => 'Детское кресло ISOFIX для детей 0-4 лет',
                    'en' => 'ISOFIX child seat for children aged 0-4',
                ],
            ],
            [
                'key' => 'booster_seat',
                'icon' => 'ti-armchair',
                'price' => 1200,
                'pricing_type' => 'per_day',
                'sort_order' => 4,
                'name' => [
                    'hy' => 'Բուստեր նստատեղ',
                    'ru' => 'Бустер',
                    'en' => 'Booster Seat',
                ],
                'description' => [
                    'hy' => 'Բուստեր նստատեղ 4-9 տարեկան երեխաների համար',
                    'ru' => 'Бустер для детей 4-9 лет',
                    'en' => 'Booster seat for children aged 4-9',
                ],
            ],
            [
                'key' => 'young_driver',
                'icon' => 'ti-school',
                'price' => 5000,
                'pricing_type' => 'flat',
                'sort_order' => 5,
                'name' => [
                    'hy' => 'Երիտասարդ վարորդ (21-25)',
                    'ru' => 'Молодой водитель (21-25)',
                    'en' => 'Young Driver (21-25)',
                ],
                'description' => [
                    'hy' => 'Լրավճար 21-25 տարեկան վարորդների համար',
                    'ru' => 'Дополнительная плата для водителей 21-25 лет',
                    'en' => 'Surcharge for drivers aged 21-25',
                ],
            ],
            [
                'key' => 'senior_driver',
                'icon' => 'ti-user-check',
                'price' => 5000,
                'pricing_type' => 'flat',
                'sort_order' => 6,
                'name' => [
                    'hy' => 'Տարեց վարորդ (65-75)',
                    'ru' => 'Пожилой водитель (65-75)',
                    'en' => 'Senior Driver (65-75)',
                ],
                'description' => [
                    'hy' => 'Լրավճար 65-75 տարեկան վարորդների համար',
                    'ru' => 'Дополнительная плата для водителей 65-75 лет',
                    'en' => 'Surcharge for drivers aged 65-75',
                ],
            ],
        ];

        foreach ($extras as $data) {
            $extra = Extra::firstOrNew(['key' => $data['key']]);
            $extra->key = $data['key'];
            $extra->icon = $data['icon'];
            $extra->price = $data['price'];
            $extra->currency = 'AMD';
            $extra->pricing_type = $data['pricing_type'];
            $extra->sort_order = $data['sort_order'];
            $extra->is_active = true;
            $extra->setTranslations('name', $data['name']);
            $extra->setTranslations('description', $data['description']);
            $extra->save();
        }
    }
}
