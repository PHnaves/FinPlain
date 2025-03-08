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
        Schema::create('metas', function (Blueprint $table) {
            $table->id();
            // relacao com a table de users
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            
            $table->string('titulo', 150); // Nome da meta (ex: "Comprar um carro")
            $table->text('descricao')->nullable();
            $table->decimal('valor_final', 10, 2); // Exemplo: R$ 50.000,00
            $table->decimal('valor_atual', 10, 2)->default(0); // Quanto já foi poupado
            $table->string('frequencia')->enum('semanal', 'mensal'); // Periodicidade dos depósitos
            $table->decimal('valor_deposito', 10, 2); // Valor que o usuário quer poupar por período
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metas');
    }
};
