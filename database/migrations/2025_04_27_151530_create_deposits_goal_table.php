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
        Schema::create('deposits_goal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('goal_id');
            $table->foreign('goal_id')->references('id')->on('goals')->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('deposit_value', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposits');
    }
};
