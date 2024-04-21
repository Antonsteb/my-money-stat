<?php

use App\Models\users\User;
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
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->enum('type',['number', 'line', 'bar']);
            $table->enum('interval', ['day', 'month', 'year'])->nullable();
            $table->unsignedSmallInteger('x')->comment('для позиционирования, на фронте в библиотеке: vue-grid-layout');
            $table->unsignedSmallInteger('y')->comment('для позиционирования, на фронте в библиотеке: vue-grid-layout');
            $table->unsignedSmallInteger('w')->comment('для размера, на фронте в библиотеке: vue-grid-layout');
            $table->unsignedSmallInteger('h')->comment('для размера, на фронте в библиотеке: vue-grid-layout');
            $table->unsignedSmallInteger('i')->comment('уникальный номер для вывода, на фронте в библиотеке: vue-grid-layout');
            $table->unique(['user_id', 'i']);
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
