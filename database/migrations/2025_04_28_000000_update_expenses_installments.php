<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Expense;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Atualiza as despesas à vista que têm parcelas = 1 para parcelas = 0
        Expense::where('recurrence', 'a vista')
              ->where('installments', 1)
              ->update(['installments' => 0]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Não é necessário reverter esta alteração
    }
}; 