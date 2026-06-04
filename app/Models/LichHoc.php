<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LichHoc extends Model
{
    use HasFactory;

    protected $table = 'lich_hoc';

    protected $fillable = [
        'yeu_cau_hoc_id',
        'gia_su_id',
        'trang_thai_ket_noi',
        'tin_nhan',
        'ngay_bat_dau',
        'ngay_hoc',
        'thu_trong_tuan',
        'gio_bat_dau',
        'gio_ket_thuc',
        'dia_diem',
        'trang_thai_buoi_hoc',
        'ghi_chu',
    ];

    protected $casts = [
        'ngay_bat_dau' => 'date',
        'ngay_hoc' => 'date',
    ];

    // Quan hệ với YeuCauHoc
    public function yeuCauHoc()
    {
        return $this->belongsTo(YeuCauHoc::class, 'yeu_cau_hoc_id');
    }

    // Quan hệ với TaiKhoan (gia sư)
    public function giaSu()
    {
        return $this->belongsTo(TaiKhoan::class, 'gia_su_id');
    }

    // Quan hệ với DanhGia
    public function danhGia()
    {
        return $this->hasMany(DanhGia::class, 'lich_hoc_id');
    }

    public function trangThaiKetNoiVietNam()
    {
        return match($this->trang_thai_ket_noi) {
            'cho_xac_nhan' => 'Chờ xác nhận',
            'da_chap_nhan' => 'Đã chấp nhận',
            'tu_choi' => 'Từ chối',
            'ket_thuc' => 'Kết thúc',
            default => 'Không xác định'
        };
    }

    public function trangThaiBuoiHocVietNam()
    {
        return match($this->trang_thai_buoi_hoc) {
            'chua_dien_ra' => 'Chưa diễn ra',
            'dang_dien_ra' => 'Đang diễn ra',
            'da_ket_thuc' => 'Đã kết thúc',
            'da_huy' => 'Đã hủy',
            default => 'Không xác định'
        };
    }
}
