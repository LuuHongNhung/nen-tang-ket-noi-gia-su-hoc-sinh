<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MonHoc extends Model
{
    use HasFactory;

    protected $table = 'mon_hoc';

    protected $fillable = [
        'ten_mon',
        'mo_ta',
    ];

    // Quan hệ với YeuCauHoc
    public function yeuCauHoc()
    {
        return $this->hasMany(YeuCauHoc::class, 'mon_hoc_id');
    }
}
