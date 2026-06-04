<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class TaiKhoan extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'tai_khoan';

    protected $fillable = [
        'ho_ten',
        'email',
        'mat_khau',
        'so_dien_thoai',
        'dia_chi',
        'vai_tro',
        'trang_thai',
        'remember_token',
    ];

    protected $hidden = [
        'mat_khau',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'mat_khau' => 'hashed',
        ];
    }

    // Quan hệ với HoSoGiaSu
    public function hoSoGiaSu()
    {
        return $this->hasOne(HoSoGiaSu::class, 'tai_khoan_id');
    }

    // Quan hệ với YeuCauHoc
    public function yeuCauHoc()
    {
        return $this->hasMany(YeuCauHoc::class, 'hoc_sinh_id');
    }

    // Quan hệ với LichHoc (gia sư)
    public function lichHocGiaSu()
    {
        return $this->hasMany(LichHoc::class, 'gia_su_id');
    }

    // Quan hệ với DanhGia
    public function danhGia()
    {
        return $this->hasMany(DanhGia::class, 'nguoi_danh_gia_id');
    }

    public function getDuongDanAvatarAttribute()
    {
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->ho_ten) . '&background=random';
    }
}
