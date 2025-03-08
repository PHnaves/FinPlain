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
        Schema::create('despesas', function (Blueprint $table) {
            $table->id();
            // relacao com a table de users
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            
            $table->string('tipo', 100); // Nome da despesa (Ex: "Aluguel", "Lazer")
            $table->decimal('valor', 10, 2);
            $table->boolean('recorrente')->default(false); // Se a despesa é fixa/mensal
            $table->date('data_vencimento')->nullable(); // Data opcional para vencimento
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('despesas');
    }
};
