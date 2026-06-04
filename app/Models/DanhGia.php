<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DanhGia extends Model
{
    use HasFactory;

    protected $table = 'danh_gia';

    protected $fillable = [
        'lich_hoc_id',
        'nguoi_danh_gia_id',
        'so_sao',
        'binh_luan',
    ];

    // Quan hệ với LichHoc
    public function lichHoc()
    {
        return $this->belongsTo(LichHoc::class, 'lich_hoc_id');
    }

    // Quan hệ với TaiKhoan (người đánh giá)
    public function nguoiDanhGia()
    {
        return $this->belongsTo(TaiKhoan::class, 'nguoi_danh_gia_id');
    }
}
