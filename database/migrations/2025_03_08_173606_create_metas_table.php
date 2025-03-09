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

            $table->string('titulo', 150);
            $table->text('descricao')->nullable();
            $table->decimal('valor_final', 10, 2);
            $table->decimal('valor_atual', 10, 2)->default(0);
            $table->enum('periodicidade', ['semanal', 'mensal']);
            $table->decimal('valor_periodico', 10, 2);
            $table->enum('status', ['andamento', 'concluída', 'cancelada'])->default('andamento');

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
