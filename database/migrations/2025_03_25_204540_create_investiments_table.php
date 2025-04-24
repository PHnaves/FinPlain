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
        Schema::create('investiments', function (Blueprint $table) {
            $table->id();
            $table->string('investiment_name', 100); // Nome do investimento
            $table->text('investiment_description'); // Descricao do investimento
            $table->string('type'); // Ex: Ações, Fundos Imobiliários, Renda Fixa
            $table->string('recommended_profile')->enum('conservador', 'moderado', 'arrojado'); // Ex: Conservador, Moderado, Arrojado
            $table->date('expiration_date'); // Ex: Data de vencimento
            $table->decimal('valor_minimo', 10, 2); // Ex: Valor sugerido para investimento
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investiments');
    }
};
