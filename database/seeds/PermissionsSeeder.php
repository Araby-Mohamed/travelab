<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'path' => 'roles',
                'name' => 'read-roles',
                'display_name' => 'Read Roles',
                'description' => 'عرض الأدوار',
            ],
            [
                'path' => 'roles',
                'name' => 'update-roles',
                'display_name' => 'Update Roles',
                'description' => 'تعديل الأدوار',
            ],
            [
                'path' => 'roles',
                'name' => 'create-roles',
                'display_name' => 'Create Roles',
                'description' => 'إضافة الأدوار',
            ],
            [
                'path' => 'roles',
                'name' => 'delete-roles',
                'display_name' => 'Delete Roles',
                'description' => 'مسح الأدوار',
            ],



            [
                'path' => 'admins',
                'name' => 'read-admins',
                'display_name' => 'Read Admins',
                'description' => 'عرض المشرفين',
            ],
            [
                'path' => 'admins',
                'name' => 'update-admins',
                'display_name' => 'Update Admins',
                'description' => 'تعديل المشرفين',
            ],
            [
                'path' => 'admins',
                'name' => 'create-admins',
                'display_name' => 'Create Admins',
                'description' => 'إضافة المشرفين',
            ],
            [
                'path' => 'admins',
                'name' => 'delete-admins',
                'display_name' => 'Delete Admins',
                'description' => 'مسح المشرفين',
            ],


            [
                'path' => 'users',
                'name' => 'read-users',
                'display_name' => 'Read Users',
                'description' => 'عرض مستخدم',
            ],
            [
                'path' => 'users',
                'name' => 'update-users',
                'display_name' => 'Update Users',
                'description' => 'تعديل مستخدم',
            ],
            [
                'path' => 'users',
                'name' => 'create-users',
                'display_name' => 'Create Users',
                'description' => 'إضافة مستخدم',
            ],
            [
                'path' => 'users',
                'name' => 'delete-users',
                'display_name' => 'Delete Users',
                'description' => 'مسح مستخدم',
            ],


            // Packages
            [
                'path' => 'packages',
                'name' => 'read-packages',
                'display_name' => 'Read Packages',
                'description' => 'عرض الباكيدج',
            ],
            [
                'path' => 'packages',
                'name' => 'approve-packages',
                'display_name' => 'Approve Packages',
                'description' => 'موافقة على الباكيدج',
            ],
            [
                'path' => 'packages',
                'name' => 'delete-packages',
                'display_name' => 'Delete Packages',
                'description' => 'مسح باكيدج',
            ],

            // Rating
            [
            'path' => 'rating',
            'name' => 'read-rating',
            'display_name' => 'Read Rating',
            'description' => 'عرض التقييمات',
            ],
            [
                'path' => 'rating',
                'name' => 'approve-rating',
                'display_name' => 'Approve Rating',
                'description' => 'موافقة على التقييمات',
            ],
            [
                'path' => 'rating',
                'name' => 'delete-rating',
                'display_name' => 'Delete Rating',
                'description' => 'مسح تقييم',
            ],

            // Links
            [
                'path' => 'links',
                'name' => 'delete-links',
                'display_name' => 'Delete Links',
                'description' => 'مسح الرابط',
            ],
            [
                'path' => 'links',
                'name' => 'read-links',
                'display_name' => 'Read Links',
                'description' => 'عرض الرابط',
            ],



            [
                'path' => 'currency',
                'name' => 'read-currency',
                'display_name' => 'Read Currency',
                'description' => 'عرض العملات',
            ],
            [
                'path' => 'currency',
                'name' => 'update-currency',
                'display_name' => 'Update Currency',
                'description' => 'تعديل العملات',
            ],
            [
                'path' => 'currency',
                'name' => 'create-currency',
                'display_name' => 'Create Currency',
                'description' => 'إضافة عملة',
            ],
            [
                'path' => 'currency',
                'name' => 'delete-currency',
                'display_name' => 'Delete Currency',
                'description' => 'مسح عملة',
            ],


            [
                'path' => 'country',
                'name' => 'read-country',
                'display_name' => 'Read Country - Governorate',
                'description' => 'عرض دولة - محافظة',
            ],
            [
                'path' => 'country',
                'name' => 'update-country',
                'display_name' => 'Update Country - Governorate',
                'description' => 'تعديل دولة - محافظة',
            ],
            [
                'path' => 'country',
                'name' => 'create-country',
                'display_name' => 'Create Country - Governorate',
                'description' => 'إضافة دولة - محافظة',
            ],
            [
                'path' => 'country',
                'name' => 'delete-country',
                'display_name' => 'Delete Country - Governorate',
                'description' => 'مسح دولة - محافظة',
            ],



            [
                'path' => 'interests',
                'name' => 'read-interests',
                'display_name' => 'Read Interests',
                'description' => 'عرض الاهتمامات',
            ],
            [
                'path' => 'interests',
                'name' => 'update-interests',
                'display_name' => 'Update Interests',
                'description' => 'تعديل اهتمامات',
            ],
            [
                'path' => 'interests',
                'name' => 'create-interests',
                'display_name' => 'Create Interests',
                'description' => 'إضافة اهتمامات',
            ],
            [
                'path' => 'interests',
                'name' => 'delete-interests',
                'display_name' => 'Delete Interests',
                'description' => 'مسح الاهتمامات',
            ],


            [
                'path' => 'messages',
                'name' => 'read-messages',
                'display_name' => 'Read Messages',
                'description' => 'عرض الرسائل',
            ],
            [
                'path' => 'messages',
                'name' => 'delete-messages',
                'display_name' => 'Delete Messages',
                'description' => 'مسح الرسائل',
            ],



            [
                'path' => 'settings',
                'name' => 'read-settings',
                'display_name' => 'Read Settings',
                'description' => 'عرض الإعدادات',
            ],
            [
                'path' => 'settings',
                'name' => 'update-settings',
                'display_name' => 'Update Settings',
                'description' => 'تعديل الإعدادات',
            ],

        ];


        foreach ($data as $get)
        {
            Permission::updateOrCreate($get);
        }

    }
}
