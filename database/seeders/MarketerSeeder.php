<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Domains\Role\Role;
use App\Domains\User\User;
use App\Enums\UserRoleEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Seeder لإنشاء 8 مسوقين بأسماء ليبية واقعية
 */
class MarketerSeeder extends Seeder
{
    public function run(): void
    {
        $marketerRole = Role::where('name', 'marketer')->first();

        $marketers = [
            ['name' => 'أحمد', 'phone' => '0921111111', 'email' => 'ahmed@marketer.com'],
            ['name' => 'علي', 'phone' => '0922222222', 'email' => 'ali@marketer.com'],
            ['name' => 'رمضان', 'phone' => '0923333333', 'email' => 'ramadan@marketer.com'],
            ['name' => 'صالح', 'phone' => '0924444444', 'email' => 'saleh@marketer.com'],
            ['name' => 'خالد', 'phone' => '0925555555', 'email' => 'khalid@marketer.com'],
            ['name' => 'محمود', 'phone' => '0926666666', 'email' => 'mahmoud@marketer.com'],
            ['name' => 'يوسف', 'phone' => '0927777777', 'email' => 'youssef@marketer.com'],
            ['name' => 'عمر', 'phone' => '0928888888', 'email' => 'omar@marketer.com'],
        ];

        foreach ($marketers as $marketer) {
            User::firstOrCreate(
                ['phone' => $marketer['phone']],
                [
                    'name' => $marketer['name'],
                    'email' => $marketer['email'],
                    'role' => UserRoleEnum::MARKETER,
                    'role_id' => $marketerRole?->id,
                    'password' => Hash::make('password'),
                ]
            );
        }
    }
}

