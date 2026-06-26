<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        $cars = [
            [
                'slug' => 'toyota-yaris',
                'category' => 'compact',
                'transmission' => 'automatic',
                'fuel_type' => 'petrol',
                'seats' => 5,
                'price_per_day' => 12000,
                'is_featured' => true,
                'sort_order' => 1,
                'name' => ['hy' => 'Toyota Yaris', 'ru' => 'Toyota Yaris', 'en' => 'Toyota Yaris'],
                'description' => [
                    'hy' => 'Տնտեսող քաղաքային մեքենա, հարմար Երևանի փողոցների և կարճ ուղևորությունների համար',
                    'ru' => 'Экономичный городской автомобиль, удобен для улиц Ереван и коротких поездок',
                    'en' => 'Economical city car, great for Yerevan streets and short trips',
                ],
            ],
            [
                'slug' => 'hyundai-i20',
                'category' => 'compact',
                'transmission' => 'manual',
                'fuel_type' => 'petrol',
                'seats' => 5,
                'price_per_day' => 10500,
                'is_featured' => false,
                'sort_order' => 2,
                'name' => ['hy' => 'Hyundai i20', 'ru' => 'Hyundai i20', 'en' => 'Hyundai i20'],
                'description' => [
                    'hy' => 'Հարմարավետ և մատչելի կոմպակտ մեքենա առաջին այցելության համար',
                    'ru' => 'Удобный и доступный компактный автомобиль для первой поездки',
                    'en' => 'Comfortable and affordable compact car, perfect for first-time visitors',
                ],
            ],
            [
                'slug' => 'toyota-camry',
                'category' => 'sedan',
                'transmission' => 'automatic',
                'fuel_type' => 'hybrid',
                'seats' => 5,
                'price_per_day' => 22000,
                'is_featured' => true,
                'sort_order' => 3,
                'name' => ['hy' => 'Toyota Camry', 'ru' => 'Toyota Camry', 'en' => 'Toyota Camry'],
                'description' => [
                    'hy' => 'Հիբրիդային սեդան՝ հանգիստ վարման և ցածր վառելիքի ծախսերի համար',
                    'ru' => 'Гибридный седан для комфортной езды и низкого расхода топлива',
                    'en' => 'Hybrid sedan offering a smooth ride and low fuel consumption',
                ],
            ],
            [
                'slug' => 'skoda-octavia',
                'category' => 'sedan',
                'transmission' => 'automatic',
                'fuel_type' => 'diesel',
                'seats' => 5,
                'price_per_day' => 18000,
                'is_featured' => false,
                'sort_order' => 4,
                'name' => ['hy' => 'Skoda Octavia', 'ru' => 'Skoda Octavia', 'en' => 'Skoda Octavia'],
                'description' => [
                    'hy' => 'Ընդարձակ սալոն և մեծ թափք՝ ընտանեկան ուղևորությունների համար',
                    'ru' => 'Просторный салон и большой багажник для семейных поездок',
                    'en' => 'Spacious cabin and large boot, ideal for family travel',
                ],
            ],
            [
                'slug' => 'toyota-rav4',
                'category' => 'suv',
                'transmission' => 'automatic',
                'fuel_type' => 'hybrid',
                'seats' => 5,
                'price_per_day' => 28000,
                'is_featured' => true,
                'sort_order' => 5,
                'name' => ['hy' => 'Toyota RAV4', 'ru' => 'Toyota RAV4', 'en' => 'Toyota RAV4'],
                'description' => [
                    'hy' => 'Հզոր հիբրիդային SUV՝ կատարյալ Դիլիջանի և Սևանի լեռնային ուղիների համար',
                    'ru' => 'Мощный гибридный SUV, идеален для горных дорог Дилижана и Севана',
                    'en' => 'Powerful hybrid SUV, perfect for the mountain roads to Dilijan and Sevan',
                ],
            ],
            [
                'slug' => 'hyundai-tucson',
                'category' => 'suv',
                'transmission' => 'automatic',
                'fuel_type' => 'diesel',
                'seats' => 5,
                'price_per_day' => 25000,
                'is_featured' => false,
                'sort_order' => 6,
                'name' => ['hy' => 'Hyundai Tucson', 'ru' => 'Hyundai Tucson', 'en' => 'Hyundai Tucson'],
                'description' => [
                    'hy' => 'Հարմարավետ և մատչելի SUV բոլոր տիպի ճանապարհների համար',
                    'ru' => 'Комфортный и доступный SUV для любых дорог',
                    'en' => 'Comfortable, affordable SUV suitable for any road',
                ],
            ],
            [
                'slug' => 'jeep-grand-cherokee',
                'category' => 'suv',
                'transmission' => 'automatic',
                'fuel_type' => 'petrol',
                'seats' => 5,
                'price_per_day' => 38000,
                'is_featured' => false,
                'sort_order' => 7,
                'name' => ['hy' => 'Jeep Grand Cherokee', 'ru' => 'Jeep Grand Cherokee', 'en' => 'Jeep Grand Cherokee'],
                'description' => [
                    'hy' => 'Հզոր լիամասշտաբ SUV՝ լեռնային և անհարթ ճանապարհների համար',
                    'ru' => 'Мощный полноразмерный SUV для горных и сложных дорог',
                    'en' => 'Powerful full-size SUV built for mountains and rough roads',
                ],
            ],
            [
                'slug' => 'bmw-5-series',
                'category' => 'premium',
                'transmission' => 'automatic',
                'fuel_type' => 'diesel',
                'seats' => 5,
                'price_per_day' => 48000,
                'is_featured' => true,
                'sort_order' => 8,
                'name' => ['hy' => 'BMW 5 Series', 'ru' => 'BMW 5 серии', 'en' => 'BMW 5 Series'],
                'description' => [
                    'hy' => 'Պրեմիում սեդան բիզնես ուղևորությունների և հատուկ առիթների համար',
                    'ru' => 'Премиальный седан для деловых поездок и особых случаев',
                    'en' => 'Premium sedan for business trips and special occasions',
                ],
            ],
            [
                'slug' => 'mercedes-e-class',
                'category' => 'premium',
                'transmission' => 'automatic',
                'fuel_type' => 'diesel',
                'seats' => 5,
                'price_per_day' => 52000,
                'is_featured' => false,
                'sort_order' => 9,
                'name' => ['hy' => 'Mercedes-Benz E-Class', 'ru' => 'Mercedes-Benz E-Class', 'en' => 'Mercedes-Benz E-Class'],
                'description' => [
                    'hy' => 'Բարձրակարգ կոմֆորտ և ոճ՝ ամենաառանձնահատուկ ուղևորությունների համար',
                    'ru' => 'Высочайший комфорт и стиль для самых особых поездок',
                    'en' => 'Top-tier comfort and style for the most special journeys',
                ],
            ],
        ];

        $depositByCategory = [
            'compact' => 50000,
            'sedan' => 70000,
            'suv' => 90000,
            'premium' => 120000,
        ];

        $bagsByCategory = [
            'compact' => 2,
            'sedan' => 3,
            'suv' => 3,
            'premium' => 3,
        ];

        foreach ($cars as $data) {
            $car = Car::firstOrNew(['slug' => $data['slug']]);
            $car->slug = $data['slug'];
            $car->category = $data['category'];
            $car->transmission = $data['transmission'];
            $car->fuel_type = $data['fuel_type'];
            $car->seats = $data['seats'];
            $car->bags = $bagsByCategory[$data['category']] ?? 2;
            $car->price_per_day = $data['price_per_day'];
            $car->deposit_amount = $depositByCategory[$data['category']] ?? 50000;
            $car->included_km_per_day = 200; // 200 km/day included, matches typical local rental terms
            $car->currency = 'AMD';
            $car->is_active = true;
            $car->is_featured = $data['is_featured'];
            $car->sort_order = $data['sort_order'];
            $car->setTranslations('name', $data['name']);
            $car->setTranslations('description', $data['description']);
            $car->save();
        }

        $this->assignCarsToLocations();
    }

    /**
     * Distribute the demo fleet across branches so each location has its
     * own realistic set of available cars (Yerevan being the main hub with
     * the widest selection, smaller branches with a relevant subset).
     */
    private function assignCarsToLocations(): void
    {
        $yerevan = \App\Models\Location::where('slug', 'yerevan')->first();
        $gyumri = \App\Models\Location::where('slug', 'gyumri')->first();
        $dilijan = \App\Models\Location::where('slug', 'dilijan')->first();
        $tsaghkadzor = \App\Models\Location::where('slug', 'tsaghkadzor')->first();

        if (!$yerevan) {
            return; // Locations not seeded yet; skip silently.
        }

        // Yerevan: the full fleet (main hub).
        $yerevan->cars()->sync(Car::pluck('id')->all());

        // Gyumri: compacts and sedans (everyday city use).
        if ($gyumri) {
            $gyumri->cars()->sync(
                Car::whereIn('category', ['compact', 'sedan'])->pluck('id')->all()
            );
        }

        // Dilijan & Tsaghkadzor: SUVs and premium (mountain roads, fewer but sturdier cars).
        $mountainCars = Car::whereIn('category', ['suv', 'premium'])->pluck('id')->all();
        if ($dilijan) {
            $dilijan->cars()->sync($mountainCars);
        }
        if ($tsaghkadzor) {
            $tsaghkadzor->cars()->sync($mountainCars);
        }
    }
}
