<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'site_phone' => env('SITE_PHONE', '+374 33 123 456'),
            'site_whatsapp' => env('SITE_WHATSAPP', '37433123456'),
            'site_email' => env('SITE_EMAIL', 'info@amarentcar.am'),
            'company_name' => 'AMAR RENT CAR ARMENIA LLC',
            'company_vat' => '02012345678',
            'working_hours' => 'Mon-Sun: 08:00 - 22:00',
            'address' => 'Komitas Ave. 38, Yerevan, Armenia',
            'facebook_url' => 'https://facebook.com/amarentcar',
            'instagram_url' => 'https://instagram.com/amarentcar',
        ];

        foreach ($settings as $key => $value) {
            Setting::set($key, $value);
        }
    }
}
