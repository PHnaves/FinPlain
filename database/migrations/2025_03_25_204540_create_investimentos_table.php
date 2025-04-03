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
        Schema::create('investimentos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->text('descricao');
            $table->string('tipo'); // Ex: Ações, Fundos Imobiliários, Renda Fixa
            $table->string('perfil_recomendado')->enum('conservador', 'moderado', 'arrojado'); // Ex: Conservador, Moderado, Arrojado
            $table->date('data_validade');
            $table->decimal('valor_minimo', 10, 2); // Ex: Valor sugerido para investimento
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investimentos');
    }
};
