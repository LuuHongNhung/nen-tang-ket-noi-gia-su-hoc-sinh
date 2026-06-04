<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class YeuCauHoc extends Model
{
    use HasFactory;

    protected $table = 'yeu_cau_hoc';

    protected $fillable = [
        'hoc_sinh_id',
        'mon_hoc_id',
        'tieu_de',
        'mo_ta',
        'lop_hoc',
        'hinh_thuc',
        'dia_chi_hoc',
        'so_buoi_tuan',
        'gia_de_xuat',
        'yeu_cau_dac_biet',
        'trang_thai',
    ];

    // Quan hệ với TaiKhoan (học sinh)
    public function hocSinh()
    {
        return $this->belongsTo(TaiKhoan::class, 'hoc_sinh_id');
    }

    // Quan hệ với MonHoc
    public function monHoc()
    {
        return $this->belongsTo(MonHoc::class, 'mon_hoc_id');
    }

    // Quan hệ với LichHoc
    public function lichHoc()
    {
        return $this->hasMany(LichHoc::class, 'yeu_cau_hoc_id');
    }

    public function trangThaiVietNam()
    {
        return match($this->trang_thai) {
            'dang_tim' => 'Đang tìm',
            'da_ghep' => 'Đã ghép',
            'da_huy' => 'Đã hủy',
            default => 'Không xác định'
        };
    }
}
