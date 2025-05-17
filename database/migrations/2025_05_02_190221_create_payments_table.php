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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');              
            $table->foreignId('reservation_id')->nullable()->constrained('reservations')->onDelete('cascade');          
            $table->enum('payment_method', ['tarjeta_credito', 'tarjeta_debito', 'transferencia']);
            $table->string('transaction_id')->nullable();
            $table->enum('status',['pendiente','completada', 'fallida'])->default('pendiente');
            $table->date('date')->nullable();
            $table->string('voucher')->nullable();
            $table->decimal('amount', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
