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
        Schema::create('earnings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            
            $table->string('title', 100); // Título do ganho
            $table->text('description')->nullable(); // Descrição do ganho
            $table->decimal('value', 10, 2); // Valor recebido
            $table->enum('recurrence', ['unico', 'semanal', 'quinzenal', 'mensal', 'trimestral', 'semestral', 'anual'])->default('unico'); // Recorrência
            $table->date('received_at'); // Data de recebimento
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('earnings');
    }
}; 