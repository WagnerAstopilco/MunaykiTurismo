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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('reservation_date');
            $table->integer('number_of_people');
            $table->enum('status',['pendiente','pagada','cancelada'])->default('pendiente'); 
            $table->decimal('total_price', 10, 2);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->foreignId('payment_id')->nullable()->constrained('payments')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
