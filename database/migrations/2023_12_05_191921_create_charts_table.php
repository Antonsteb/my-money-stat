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
        Schema::create('charts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id');
            $table->enum('type',['number', 'line', 'bar']);
            $table->enum('interval',['day', 'month', 'year'])->nullable();
            $table->unsignedSmallInteger('x')->comment('для позиционирования, на фронте в библиотеке: vue-grid-layout');
            $table->unsignedSmallInteger('y')->comment('для позиционирования, на фронте в библиотеке: vue-grid-layout');
            $table->unsignedSmallInteger('w')->comment('для размера, на фронте в библиотеке: vue-grid-layout');
            $table->unsignedSmallInteger('h')->comment('для размера, на фронте в библиотеке: vue-grid-layout');
            $table->unsignedSmallInteger('i')->comment('номер для вывода, на фронте в библиотеке: vue-grid-layout');

            $table->foreign('category_id')->references('id')->on('categories')
                ->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('charts');
    }
};
