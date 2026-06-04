<?php

namespace App\Http\Controllers;

use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class XacThucController extends Controller
{
    // Hiển thị form đăng ký
    public function hienThiBieuMauDangKy()
    {
        return view('auth.dang_ky');
    }

    // Xử lý đăng ký
    public function xuLyDangKy(Request $request)
    {
        $request->validate([
            'ho_ten' => 'required|string|max:100',
            'email' => 'required|email|unique:tai_khoan,email',
            'mat_khau' => 'required|min:6|confirmed',
            'so_dien_thoai' => 'required|digits:10',
            'vai_tro' => 'required|in:gia_su,hoc_sinh',
        ], [
            'ho_ten.required' => 'Họ tên không được để trống',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email đã được đăng ký',
            'mat_khau.required' => 'Mật khẩu không được để trống',
            'mat_khau.min' => 'Mật khẩu tối thiểu 6 ký tự',
            'mat_khau.confirmed' => 'Mật khẩu xác nhận không khớp',
            'so_dien_thoai.required' => 'Số điện thoại không được để trống',
            'so_dien_thoai.digits' => 'Số điện thoại phải là 10 chữ số',
            'vai_tro.required' => 'Vai trò không được để trống',
        ]);

        $taiKhoan = TaiKhoan::create([
            'ho_ten' => $request->ho_ten,
            'email' => $request->email,
            'mat_khau' => Hash::make($request->mat_khau),
            'so_dien_thoai' => $request->so_dien_thoai,
            'vai_tro' => $request->vai_tro,
            'trang_thai' => 'hoat_dong',
        ]);

        Auth::login($taiKhoan);

        return redirect()->route('trang_chu')->with('thong_bao', 'Đăng ký thành công!');
    }

    // Hiển thị form đăng nhập
    public function hienThiBieuMauDangNhap()
    {
        return view('auth.dang_nhap');
    }

    // Xử lý đăng nhập
    public function xuLyDangNhap(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'mat_khau' => 'required',
        ], [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không hợp lệ',
            'mat_khau.required' => 'Mật khẩu không được để trống',
        ]);

        $taiKhoan = TaiKhoan::where('email', $request->email)->first();

        if (!$taiKhoan || !Hash::check($request->mat_khau, $taiKhoan->mat_khau)) {
            return back()->withErrors(['dang_nhap' => 'Email hoặc mật khẩu không chính xác']);
        }

        if ($taiKhoan->trang_thai === 'khoa') {
            return back()->withErrors(['dang_nhap' => 'Tài khoản của bạn đã bị khóa']);
        }

        Auth::login($taiKhoan, $request->remember);

        return redirect()->route('trang_chu')->with('thong_bao', 'Đăng nhập thành công!');
    }

    // Đăng xuất
    public function dangXuat()
    {
        Auth::logout();
        return redirect()->route('trang_chu')->with('thong_bao', 'Đã đăng xuất');
    }
}
