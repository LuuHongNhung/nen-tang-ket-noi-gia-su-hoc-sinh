<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ho_so_gia_su', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tai_khoan_id')->constrained('tai_khoan');
            $table->longText('bang_cap')->nullable();
            $table->longText('kinh_nghiem')->nullable();
            $table->string('chuyen_mon', 255)->nullable();
            $table->decimal('tien_luong_gio_cong', 11, 3)->nullable();
            $table->enum('hinh_thuc_day', ['truc_tuyen', 'ngoai_tuyen', 'ket_hop'])->default('ket_hop');
            $table->string('dia_chi_day', 255)->nullable();
            $table->longText('gioi_thieu')->nullable();
            $table->longText('danh_sach_lop_da_day')->nullable();
            $table->integer('so_gio_da_day')->default(0);
            $table->decimal('danh_gia_trung_binh', 3, 1)->default(0);
            $table->integer('so_luot_danh_gia')->default(0);
            $table->enum('trang_thai', ['cho_duyet', 'da_duyet', 'tu_choi'])->default('cho_duyet');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ho_so_gia_su');
    }
};
