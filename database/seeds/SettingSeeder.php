<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'default_timezone' => 'Africa/Cairo',
            'phone_1' => '8484858845855',
            'phone_2' => '939058050544',
            'email_1' => 'info@saudi-business.com',
            'email_2' => 'support@saudi-business.com',
            'logo' => 'images/setting/20102653313736775.png',
            'logo_white' => 'images/setting/20102653313635746.png',
            'favicon' => 'images/setting/20102653313421437.png',
            'favicon_white' => 'images/setting/20102653313849085.png',
            'location' => null,
            'facebook' => 'https://www.facebook.com',
            'twitter' => null,
            'instagram' => null,
            'pinterest' => null,
            'snapchat' => null,
            'youtube' => null,
            'site_name' => 'Saudi Business',
            'address' => 'Test',
            'sm_description' => 'small description about application',
            'copyright' => 'جميع الحقوق محفوظة سعودي بيزنس',
            'copyright_link_text' => null,
            'copyright_link' => null,

        ];
        Setting::setMany($data);
    }
}
