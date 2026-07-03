<?php

namespace Database\Seeders;

use App\Models\WebsiteSetting;
use Illuminate\Database\Seeder;

class WebsiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        WebsiteSetting::firstOrCreate(
            ['id' => 1],
            [

                'company_name' => 'Becta Logistics',

                'tagline' => 'Integrated Marine Logistics Solution',

                'company_description' => '',

                'email' => '',

                'phone' => '',

                'mobile' => '',

                'whatsapp' => '',

                'fax' => '',

                'address' => '',

                'latitude' => null,

                'longitude' => null,

                'google_maps' => '',

                'office_hours' => '',

                'facebook' => '',

                'instagram' => '',

                'linkedin' => '',

                'youtube' => '',

                'tiktok' => '',

                'twitter' => '',

                'footer_text' => '',

                'copyright' => '© ' . date('Y') . ' Becta Logistics',

                'default_seo_title' => 'Becta Logistics',

                'default_seo_description' => '',

            ]
        );
    }
}