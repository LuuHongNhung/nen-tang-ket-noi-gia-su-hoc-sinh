<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('danh_gia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lich_hoc_id')->constrained('lich_hoc');
            $table->foreignId('nguoi_danh_gia_id')->constrained('tai_khoan');
            $table->tinyInteger('so_sao');
            $table->longText('binh_luan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('danh_gia');
    }
};
