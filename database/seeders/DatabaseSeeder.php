<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Tạo tài khoản Admin
        DB::table('tai_khoan')->insert([
            'ho_ten' => 'Quản Trị Viên',
            'email' => 'admin@giasu.vn',
            'mat_khau' => Hash::make('123456'),
            'so_dien_thoai' => '0912345678',
            'dia_chi' => 'Hà Nội',
            'vai_tro' => 'admin',
            'trang_thai' => 'hoat_dong',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Tạo các môn học
        $mon_hoc = [
            ['ten_mon' => 'Toán', 'mo_ta' => 'Dạy các môn Toán từ tiểu học đến lớp 12'],
            ['ten_mon' => 'Văn', 'mo_ta' => 'Dạy môn Văn và kỹ năng viết lách'],
            ['ten_mon' => 'Anh', 'mo_ta' => 'Dạy tiếng Anh từ cơ bản đến nâng cao'],
            ['ten_mon' => 'Lý', 'mo_ta' => 'Dạy môn Vật Lý'],
            ['ten_mon' => 'Hóa', 'mo_ta' => 'Dạy môn Hóa học'],
            ['ten_mon' => 'Sinh', 'mo_ta' => 'Dạy môn Sinh học'],
            ['ten_mon' => 'Sử', 'mo_ta' => 'Dạy môn Lịch Sử'],
            ['ten_mon' => 'Địa', 'mo_ta' => 'Dạy môn Địa lý'],
            ['ten_mon' => 'Tin', 'mo_ta' => 'Dạy môn Tin học'],
        ];

        foreach ($mon_hoc as $mon) {
            DB::table('mon_hoc')->insert([
                'ten_mon' => $mon['ten_mon'],
                'mo_ta' => $mon['mo_ta'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
