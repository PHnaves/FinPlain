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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            // relacao com a table de users
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            
            $table->string('expense_name', 100); // Nome da despesa (Ex: "Aluguel", "Lazer")
            $table->text('expense_description');// Descricao da despesa
            $table->string('expense_category', 100); // Categoria da despesa (Ex: "Aluguel", "Lazer")
            $table->decimal('expense_value', 10, 2); // Valor da despesa
            $table->enum('recurrence', ['a vista', 'semanal', 'quinzenal', 'mensal', 'trimestral', 'semestral', 'anual',]); // Frequencia da despesa
            $table->integer('installments')->default(0); // Numero de parcelas
            $table->dateTime('due_date'); // Data de vencimento
            $table->datetime('payment_date')->nullable(); // Data de pagamento
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
