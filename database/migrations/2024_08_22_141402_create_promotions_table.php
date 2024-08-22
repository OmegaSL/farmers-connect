<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('e.g., Summer Sale, 10% Off');
            $table->text('description')->nullable();
            $table->enum('discount_type', ['percentage', 'fixed_amount'])->comment('e.g., percentage, fixed_amount');
            $table->decimal('discount_value', 8, 2);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
