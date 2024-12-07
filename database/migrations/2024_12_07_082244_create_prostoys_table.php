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
        Schema::create('prostoys', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->foreignId('client_id')->constrained('users');
            $table->foreignId('carrier_id')->constrained('users');
            $table->foreignId('sales_id')->constrained('users');
            $table->foreignId('operation_id')->constrained('users');
            $table->decimal('carrier_amount', 10, 2);
            $table->string('carrier_currency');
            $table->decimal('client_amount', 10, 2);
            $table->string('client_currency');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prostoys');
    }
};
