<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Domains\Permission\Permission;
use App\Domains\Role\Role;
use Illuminate\Database\Seeder;

/**
 * Seeder لإنشاء الأدوار والصلاحيات الأساسية
 */
class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // إنشاء الصلاحيات
        $permissions = [
            ['name' => 'view_dashboard', 'display_name' => 'عرض لوحة التحكم'],
            ['name' => 'manage_marketers', 'display_name' => 'إدارة المسوقين'],
            ['name' => 'manage_stores', 'display_name' => 'إدارة المتاجر'],
            ['name' => 'manage_products', 'display_name' => 'إدارة المنتجات'],
            ['name' => 'issue_stock', 'display_name' => 'إعطاء بضاعة'],
            ['name' => 'record_sales', 'display_name' => 'تسجيل مبيعات'],
            ['name' => 'manage_returns', 'display_name' => 'إدارة الإرجاعات'],
            ['name' => 'manage_invoices', 'display_name' => 'إدارة الفواتير'],
            ['name' => 'view_reports', 'display_name' => 'عرض التقارير'],
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission['name']],
                ['display_name' => $permission['display_name']]
            );
        }

        // إنشاء دور Admin
        $adminRole = Role::firstOrCreate(
            ['name' => 'admin'],
            ['display_name' => 'مدير النظام']
        );

        // إعطاء Admin كل الصلاحيات
        $adminRole->permissions()->sync(Permission::all()->pluck('id'));

        // إنشاء دور Marketer
        $marketerRole = Role::firstOrCreate(
            ['name' => 'marketer'],
            ['display_name' => 'مسوق']
        );

        // إعطاء Marketer صلاحيات محددة
        $marketerPermissions = Permission::whereIn('name', [
            'view_dashboard',
            'record_sales',
            'view_reports',
        ])->pluck('id');

        $marketerRole->permissions()->sync($marketerPermissions);
    }
}


