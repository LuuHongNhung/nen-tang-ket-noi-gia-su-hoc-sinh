<?php

namespace App\Http\Controllers;

use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class QuanLyTaiKhoanController extends Controller
{
    // Hiển thị thông tin tài khoản
    public function hienThiThongTin()
    {
        $taiKhoan = Auth::user();
        return view('tai_khoan.thong_tin', compact('taiKhoan'));
    }

    // Cập nhật thông tin tài khoản
    public function capNhatThongTin(Request $request)
    {
        $taiKhoan = Auth::user();

        $request->validate([
            'ho_ten' => 'required|string|max:100',
            'so_dien_thoai' => 'required|digits:10',
            'dia_chi' => 'nullable|string|max:255',
        ], [
            'ho_ten.required' => 'Họ tên không được để trống',
            'so_dien_thoai.required' => 'Số điện thoại không được để trống',
            'so_dien_thoai.digits' => 'Số điện thoại phải là 10 chữ số',
        ]);

        $taiKhoan->update([
            'ho_ten' => $request->ho_ten,
            'so_dien_thoai' => $request->so_dien_thoai,
            'dia_chi' => $request->dia_chi,
        ]);

        return back()->with('thong_bao', 'Cập nhật thông tin thành công!');
    }

    // Đổi mật khẩu
    public function doiMatKhau(Request $request)
    {
        $request->validate([
            'mat_khau_cu' => 'required',
            'mat_khau_moi' => 'required|min:6|confirmed',
        ], [
            'mat_khau_cu.required' => 'Mật khẩu cũ không được để trống',
            'mat_khau_moi.required' => 'Mật khẩu mới không được để trống',
            'mat_khau_moi.min' => 'Mật khẩu mới tối thiểu 6 ký tự',
            'mat_khau_moi.confirmed' => 'Mật khẩu xác nhận không khớp',
        ]);

        $taiKhoan = Auth::user();

        if (!Hash::check($request->mat_khau_cu, $taiKhoan->mat_khau)) {
            return back()->withErrors(['mat_khau_cu' => 'Mật khẩu cũ không chính xác']);
        }

        $taiKhoan->update([
            'mat_khau' => Hash::make($request->mat_khau_moi),
        ]);

        return back()->with('thong_bao', 'Đổi mật khẩu thành công!');
    }
}
