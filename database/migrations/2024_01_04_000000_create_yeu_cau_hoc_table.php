<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('yeu_cau_hoc', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hoc_sinh_id')->constrained('tai_khoan');
            $table->foreignId('mon_hoc_id')->constrained('mon_hoc');
            $table->string('tieu_de', 200);
            $table->longText('mo_ta');
            $table->string('lop_hoc', 50);
            $table->enum('hinh_thuc', ['truc_tuyen', 'ngoai_tuyen', 'ket_hop']);
            $table->string('dia_chi_hoc', 255)->nullable();
            $table->integer('so_buoi_tuan')->default(0);
            $table->decimal('gia_de_xuat', 11, 3)->nullable();
            $table->longText('yeu_cau_dac_biet')->nullable();
            $table->enum('trang_thai', ['dang_tim', 'da_ghep', 'da_huy'])->default('dang_tim');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('yeu_cau_hoc');
    }
};
