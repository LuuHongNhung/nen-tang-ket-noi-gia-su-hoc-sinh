<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lich_hoc', function (Blueprint $table) {
            $table->id();
            $table->foreignId('yeu_cau_hoc_id')->constrained('yeu_cau_hoc');
            $table->foreignId('gia_su_id')->constrained('tai_khoan');
            $table->enum('trang_thai_ket_noi', ['cho_xac_nhan', 'da_chap_nhan', 'tu_choi', 'ket_thuc'])->default('cho_xac_nhan');
            $table->longText('tin_nhan')->nullable();
            $table->date('ngay_bat_dau')->nullable();
            $table->date('ngay_hoc');
            $table->tinyInteger('thu_trong_tuan')->nullable();
            $table->time('gio_bat_dau');
            $table->time('gio_ket_thuc');
            $table->string('dia_diem', 255)->nullable();
            $table->enum('trang_thai_buoi_hoc', ['chua_dien_ra', 'dang_dien_ra', 'da_ket_thuc', 'da_huy'])->default('chua_dien_ra');
            $table->longText('ghi_chu')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lich_hoc');
    }
};
