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
        Schema::create('bank_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum('bank_name',['tinkoff', 'sberbank']);
            $table->string('bank_category_name',150);
            $table->string('description');
            $table->float('price');
            $table->timestamp('date');

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');
            $table->index('bank_category_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_payments');
    }
};
