<?php

namespace App\Http\Controllers;

use App\Models\HoSoGiaSu;
use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuanLyHoSoGiaSuController extends Controller
{
    // Hiển thị hồ sơ gia sư
    public function hienThiHoSo()
    {
        $taiKhoan = Auth::user();
        $hoSo = $taiKhoan->hoSoGiaSu;

        if (!$hoSo) {
            return redirect()->route('giasu.tao_ho_so');
        }

        return view('gia_su.ho_so', compact('hoSo'));
    }

    // Hiển thị form tạo hồ sơ
    public function hienThiBieuMauTaoHoSo()
    {
        return view('gia_su.tao_ho_so');
    }

    // Tạo hồ sơ
    public function taoHoSo(Request $request)
    {
        $request->validate([
            'bang_cap' => 'required|string',
            'kinh_nghiem' => 'required|string',
            'chuyen_mon' => 'required|string|max:255',
            'tien_luong_gio_cong' => 'required|numeric|min:0',
            'hinh_thuc_day' => 'required|in:truc_tuyen,ngoai_tuyen,ket_hop',
            'dia_chi_day' => 'nullable|string|max:255',
            'gioi_thieu' => 'nullable|string',
        ], [
            'bang_cap.required' => 'Bằng cấp không được để trống',
            'kinh_nghiem.required' => 'Kinh nghiệm không được để trống',
            'chuyen_mon.required' => 'Chuyên môn không được để trống',
            'tien_luong_gio_cong.required' => 'Tiền lương không được để trống',
            'tien_luong_gio_cong.numeric' => 'Tiền lương phải là số',
            'hinh_thuc_day.required' => 'Hình thức dạy không được để trống',
        ]);

        $taiKhoan = Auth::user();

        $hoSo = HoSoGiaSu::create([
            'tai_khoan_id' => $taiKhoan->id,
            'bang_cap' => $request->bang_cap,
            'kinh_nghiem' => $request->kinh_nghiem,
            'chuyen_mon' => $request->chuyen_mon,
            'tien_luong_gio_cong' => $request->tien_luong_gio_cong,
            'hinh_thuc_day' => $request->hinh_thuc_day,
            'dia_chi_day' => $request->dia_chi_day,
            'gioi_thieu' => $request->gioi_thieu,
            'trang_thai' => 'cho_duyet',
        ]);

        return redirect()->route('giasu.ho_so')->with('thong_bao', 'Tạo hồ sơ thành công! Chờ admin duyệt.');
    }

    // Hiển thị form chỉnh sửa hồ sơ
    public function hienThiBieuMauChinhSua()
    {
        $taiKhoan = Auth::user();
        $hoSo = $taiKhoan->hoSoGiaSu;

        if (!$hoSo) {
            return redirect()->route('giasu.tao_ho_so');
        }

        return view('gia_su.chinh_sua_ho_so', compact('hoSo'));
    }

    // Cập nhật hồ sơ
    public function capNhatHoSo(Request $request)
    {
        $request->validate([
            'bang_cap' => 'required|string',
            'kinh_nghiem' => 'required|string',
            'chuyen_mon' => 'required|string|max:255',
            'tien_luong_gio_cong' => 'required|numeric|min:0',
            'hinh_thuc_day' => 'required|in:truc_tuyen,ngoai_tuyen,ket_hop',
            'dia_chi_day' => 'nullable|string|max:255',
            'gioi_thieu' => 'nullable|string',
        ]);

        $taiKhoan = Auth::user();
        $hoSo = $taiKhoan->hoSoGiaSu;

        $hoSo->update([
            'bang_cap' => $request->bang_cap,
            'kinh_nghiem' => $request->kinh_nghiem,
            'chuyen_mon' => $request->chuyen_mon,
            'tien_luong_gio_cong' => $request->tien_luong_gio_cong,
            'hinh_thuc_day' => $request->hinh_thuc_day,
            'dia_chi_day' => $request->dia_chi_day,
            'gioi_thieu' => $request->gioi_thieu,
        ]);

        return redirect()->route('giasu.ho_so')->with('thong_bao', 'Cập nhật hồ sơ thành công!');
    }

    // Xóa hồ sơ
    public function xoaHoSo()
    {
        $taiKhoan = Auth::user();
        $hoSo = $taiKhoan->hoSoGiaSu;

        if ($hoSo) {
            $hoSo->delete();
        }

        return redirect()->route('giasu.tao_ho_so')->with('thong_bao', 'Xóa hồ sơ thành công!');
    }

    // Hiển thị danh sách các gia sư (cho admin)
    public function danhSachHoSo()
    {
        $hoSo = HoSoGiaSu::with('taiKhoan')->paginate(10);
        return view('admin.danh_sach_ho_so', compact('hoSo'));
    }

    // Duyệt hồ sơ gia sư (admin)
    public function duyetHoSo($id)
    {
        $hoSo = HoSoGiaSu::findOrFail($id);
        $hoSo->update(['trang_thai' => 'da_duyet']);
        return back()->with('thong_bao', 'Duyệt hồ sơ thành công!');
    }

    // Từ chối hồ sơ gia sư (admin)
    public function tuChoiHoSo($id)
    {
        $hoSo = HoSoGiaSu::findOrFail($id);
        $hoSo->update(['trang_thai' => 'tu_choi']);
        return back()->with('thong_bao', 'Từ chối hồ sơ thành công!');
    }
}
