<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tai_khoan', function (Blueprint $table) {
            $table->id();
            $table->string('ho_ten', 100);
            $table->string('email', 100)->unique();
            $table->string('mat_khau', 255);
            $table->string('so_dien_thoai', 10);
            $table->string('dia_chi', 255)->nullable();
            $table->enum('vai_tro', ['admin', 'gia_su', 'hoc_sinh']);
            $table->enum('trang_thai', ['hoat_dong', 'khoa'])->default('hoat_dong');
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tai_khoan');
    }
};
