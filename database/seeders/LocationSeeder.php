<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $locations = [
            [
                'slug' => 'yerevan',
                'icon' => 'ti-building-skyscraper',
                'latitude' => 40.1872,
                'longitude' => 44.5152,
                'sort_order' => 1,
                'name' => [
                    'hy' => 'Երևան',
                    'ru' => 'Ереван',
                    'en' => 'Yerevan',
                ],
                'description' => [
                    'hy' => 'Մայրաքաղաք՝ օդանավակայանով, քաղաքային գրասենյակով և լայն ավտոպարկով',
                    'ru' => 'Столица с аэропортом, городским офисом и большим автопарком',
                    'en' => 'The capital, with an airport branch, city-centre office and our widest fleet',
                ],
                'address' => [
                    'hy' => 'Կոմիտաս պող. 38, Երևան / «Զվարթնոց» օդանավակայան',
                    'ru' => 'Просп. Комитаса 38, Ереван / Аэропорт «Звартноц»',
                    'en' => 'Komitas Ave. 38, Yerevan / Zvartnots Airport',
                ],
                'working_hours' => [
                    'hy' => 'Ամեն օր՝ 08:00 - 22:00, գիշերային ստացում նախնական պատվերով',
                    'ru' => 'Ежедневно: 08:00 - 22:00, ночная выдача по предварительной заявке',
                    'en' => 'Daily 08:00 - 22:00, night pickup available on request',
                ],
            ],
            [
                'slug' => 'gyumri',
                'icon' => 'ti-building-church',
                'latitude' => 40.7942,
                'longitude' => 43.8474,
                'sort_order' => 2,
                'name' => [
                    'hy' => 'Գյումրի',
                    'ru' => 'Гюмри',
                    'en' => 'Gyumri',
                ],
                'description' => [
                    'hy' => 'Հայաստանի երկրորդ ամենամեծ քաղաքը, հայտնի իր պատմական ճարտարապետությունով',
                    'ru' => 'Второй по величине город Армении, известный исторической архитектурой',
                    'en' => "Armenia's second-largest city, known for its historic architecture",
                ],
                'address' => [
                    'hy' => 'Վարդանանց հրապարակ, Գյումրի',
                    'ru' => 'Площадь Вардананц, Гюмри',
                    'en' => 'Vardanants Square, Gyumri',
                ],
                'working_hours' => [
                    'hy' => 'Ամեն օր՝ 09:00 - 20:00',
                    'ru' => 'Ежедневно: 09:00 - 20:00',
                    'en' => 'Daily 09:00 - 20:00',
                ],
            ],
            [
                'slug' => 'dilijan',
                'icon' => 'ti-trees',
                'latitude' => 40.7397,
                'longitude' => 44.8650,
                'sort_order' => 3,
                'name' => [
                    'hy' => 'Դիլիջան',
                    'ru' => 'Дилижан',
                    'en' => 'Dilijan',
                ],
                'description' => [
                    'hy' => 'Անտառապատ «Հայկական Շվեյցարիա»՝ Տավուշի մարզում, մեկնակետ դեպի Հաղարծին և Սևան',
                    'ru' => 'Лесистая «Армянская Швейцария» в Тавушской области, отправная точка к Агарцину и Севану',
                    'en' => 'Forested "Armenian Switzerland" in Tavush, a gateway to Haghartsin and Lake Sevan',
                ],
                'address' => [
                    'hy' => 'Մյասնիկյան փողոց, Դիլիջան',
                    'ru' => 'Улица Мясникяна, Дилижан',
                    'en' => 'Myasnikyan Street, Dilijan',
                ],
                'working_hours' => [
                    'hy' => 'Ամեն օր՝ 09:00 - 19:00',
                    'ru' => 'Ежедневно: 09:00 - 19:00',
                    'en' => 'Daily 09:00 - 19:00',
                ],
            ],
            [
                'slug' => 'tsaghkadzor',
                'icon' => 'ti-mountain',
                'latitude' => 40.5394,
                'longitude' => 44.7144,
                'sort_order' => 4,
                'name' => [
                    'hy' => 'Ծաղկաձոր',
                    'ru' => 'Цахкадзор',
                    'en' => 'Tsaghkadzor',
                ],
                'description' => [
                    'hy' => 'Լեռնադահուկային հանգուցակետ Արագածի և Ծաղկունյաց լեռնաշղթայի ստորոտին',
                    'ru' => 'Горнолыжный курорт у подножия хребта Цахкуняц',
                    'en' => 'Ski resort town at the foot of the Tsaghkunyats mountain range',
                ],
                'address' => [
                    'hy' => 'Ճամբարակի խճուղի, Ծաղկաձոր',
                    'ru' => 'Джамбаракское шоссе, Цахкадзор',
                    'en' => 'Jambarak Highway, Tsaghkadzor',
                ],
                'working_hours' => [
                    'hy' => 'Հոկտեմբեր-մայիս, ըստ պատվերի',
                    'ru' => 'Октябрь-май, по предварительной заявке',
                    'en' => 'October-May, by prior arrangement',
                ],
            ],
        ];

        foreach ($locations as $data) {
            $location = Location::firstOrNew(['slug' => $data['slug']]);
            $location->slug = $data['slug'];
            $location->icon = $data['icon'];
            $location->latitude = $data['latitude'];
            $location->longitude = $data['longitude'];
            $location->sort_order = $data['sort_order'];
            $location->is_active = true;
            $location->setTranslations('name', $data['name']);
            $location->setTranslations('description', $data['description']);
            $location->setTranslations('address', $data['address']);
            $location->setTranslations('working_hours', $data['working_hours']);
            $location->save();
        }
    }
}
