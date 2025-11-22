<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * تعديل جدول المستخدمين - إضافة الحقول المطلوبة للجدول الموجود
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->unique()->after('name');
            $table->enum('role', ['admin', 'marketer'])->after('phone');
            $table->foreignId('role_id')->nullable()->constrained('roles')->cascadeOnDelete()->after('role');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn(['phone', 'role', 'role_id']);
        });
    }
};