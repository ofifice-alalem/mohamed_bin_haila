<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

/**
 * Seeder الرئيسي الذي يستدعي كل الـ Seeders بالترتيب
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // تعطيل حماية Mass Assignment
        Model::unguard();

        // ترتيب تنفيذ الـ Seeders
        $this->call([
            RoleAndPermissionSeeder::class,  // 1. الأدوار والصلاحيات أولاً
            AdminUserSeeder::class,          // 2. إنشاء Admin
            ProductSeeder::class,             // 3. المنتجات
            StoreSeeder::class,              // 4. المتاجر
            MarketerSeeder::class,           // 5. المسوقين
            StockMovementSeeder::class,       // 6. حركات المخزون
            SaleSeeder::class,               // 7. المبيعات
            ReturnSeeder::class,             // 8. الإرجاعات
        ]);

        // إعادة تفعيل حماية Mass Assignment
        Model::reguard();
    }
}
