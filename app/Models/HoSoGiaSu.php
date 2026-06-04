<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HoSoGiaSu extends Model
{
    use HasFactory;

    protected $table = 'ho_so_gia_su';

    protected $fillable = [
        'tai_khoan_id',
        'bang_cap',
        'kinh_nghiem',
        'chuyen_mon',
        'tien_luong_gio_cong',
        'hinh_thuc_day',
        'dia_chi_day',
        'gioi_thieu',
        'danh_sach_lop_da_day',
        'so_gio_da_day',
        'danh_gia_trung_binh',
        'so_luot_danh_gia',
        'trang_thai',
    ];

    // Quan hệ với TaiKhoan
    public function taiKhoan()
    {
        return $this->belongsTo(TaiKhoan::class, 'tai_khoan_id');
    }

    public function trangThaiVietNam()
    {
        return match($this->trang_thai) {
            'cho_duyet' => 'Chờ duyệt',
            'da_duyet' => 'Đã duyệt',
            'tu_choi' => 'Từ chối',
            default => 'Không xác định'
        };
    }
}
