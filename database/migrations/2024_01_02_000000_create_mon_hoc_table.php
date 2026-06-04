<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mon_hoc', function (Blueprint $table) {
            $table->id();
            $table->string('ten_mon', 50)->unique();
            $table->string('mo_ta', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mon_hoc');
    }
};
