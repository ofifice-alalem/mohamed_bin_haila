<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * جدول الفواتير - يحتوي على فواتير المبيعات المرسلة للمتاجر
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('store_id')->constrained('stores')->cascadeOnDelete();
            $table->string('invoice_number')->unique();
            $table->decimal('total_amount', 10, 2);
            $table->date('period_start');
            $table->date('period_end');
            $table->enum('status', ['sent', 'paid', 'pending'])->default('pending');
            $table->string('pdf_path')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();
            $table->index(['store_id', 'period_start', 'period_end']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};