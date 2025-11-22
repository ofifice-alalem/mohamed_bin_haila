<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * جدول حركة المخزون - يتتبع كمية المنتجات التي يأخذها كل مسوق يومياً
     */
    public function up(): void
    {
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('marketer_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('quantity_taken');
            $table->unsignedInteger('quantity_sold')->default(0);
            $table->unsignedInteger('quantity_remaining');
            $table->date('movement_date');
            $table->timestamps();
            $table->unique(['marketer_id', 'product_id', 'movement_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};