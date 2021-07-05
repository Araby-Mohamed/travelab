<?php

use \App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'username' => 'مدير النظام',
            'email' => 'test@test.com',
            'password' => bcrypt(123456),
            'phone' => '0987654321',
        ];
        Admin::create($data);
    }
}
