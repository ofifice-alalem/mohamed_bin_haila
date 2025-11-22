<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * جدول المبيعات - يسجل جميع عمليات البيع التي تتم من المسوقين للمتاجر
     */
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('marketer_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('store_id')->constrained('stores')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->unsignedInteger('quantity');
            $table->decimal('price_at_sale', 10, 2);
            $table->decimal('total', 10, 2);
            $table->date('sale_date');
            $table->boolean('invoice_sent')->default(false);
            $table->timestamps();
            $table->index(['marketer_id', 'sale_date']);
            $table->index(['store_id', 'sale_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};