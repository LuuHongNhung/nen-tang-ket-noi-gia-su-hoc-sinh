<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrangChuController;
use App\Http\Controllers\XacThucController;
use App\Http\Controllers\QuanLyTaiKhoanController;
use App\Http\Controllers\QuanLyHoSoGiaSuController;
use App\Http\Controllers\QuanLyYeuCauHocController;
use App\Http\Controllers\TimKiemGiaSuController;
use App\Http\Controllers\QuanLyKetNoiController;
use App\Http\Controllers\QuanLyAdminController;

Route::get('/', [TrangChuController::class, 'index'])->name('trang_chu');

// Auth Routes
Route::get('/dang-ky', [XacThucController::class, 'hienThiBieuMauDangKy'])->name('dang_ky');
Route::post('/dang-ky', [XacThucController::class, 'xuLyDangKy'])->name('xu_ly_dang_ky');
Route::get('/dang-nhap', [XacThucController::class, 'hienThiBieuMauDangNhap'])->name('dang_nhap');
Route::post('/dang-nhap', [XacThucController::class, 'xuLyDangNhap'])->name('xu_ly_dang_nhap');
Route::post('/dang-xuat', [XacThucController::class, 'dangXuat'])->name('dang_xuat');

// Tai Khoan Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/tai-khoan/thong-tin', [QuanLyTaiKhoanController::class, 'hienThiThongTin'])->name('tai_khoan.thong_tin');
    Route::post('/tai-khoan/cap-nhat', [QuanLyTaiKhoanController::class, 'capNhatThongTin'])->name('tai_khoan.cap_nhat');
    Route::post('/tai-khoan/doi-mat-khau', [QuanLyTaiKhoanController::class, 'doiMatKhau'])->name('tai_khoan.doi_mat_khau');
});

// Gia Su Routes
Route::middleware(['auth', 'gia_su'])->group(function () {
    Route::get('/gia-su/ho-so', [QuanLyHoSoGiaSuController::class, 'hienThiHoSo'])->name('giasu.ho_so');
    Route::get('/gia-su/tao-ho-so', [QuanLyHoSoGiaSuController::class, 'hienThiBieuMauTaoHoSo'])->name('giasu.tao_ho_so');
    Route::post('/gia-su/tao-ho-so', [QuanLyHoSoGiaSuController::class, 'taoHoSo'])->name('giasu.xu_ly_tao_ho_so');
    Route::get('/gia-su/chinh-sua-ho-so', [QuanLyHoSoGiaSuController::class, 'hienThiBieuMauChinhSua'])->name('giasu.chinh_sua_ho_so');
    Route::post('/gia-su/chinh-sua-ho-so', [QuanLyHoSoGiaSuController::class, 'capNhatHoSo'])->name('giasu.cap_nhat_ho_so');
    Route::post('/gia-su/xoa-ho-so', [QuanLyHoSoGiaSuController::class, 'xoaHoSo'])->name('giasu.xoa_ho_so');

    Route::get('/gia-su/yeu-cau-cho', [QuanLyKetNoiController::class, 'danhSachYeuCauCho'])->name('giasu.yeu_cau_cho');
    Route::post('/gia-su/dang-ky-day/{id}', [QuanLyKetNoiController::class, 'dangKyDay'])->name('giasu.dang_ky_day');
    Route::get('/gia-su/lich-hoc', [QuanLyKetNoiController::class, 'danhSachLichHocGiaSu'])->name('giasu.danh_sach_lich_hoc');
});

// Hoc Sinh Routes
Route::middleware(['auth', 'hoc_sinh'])->group(function () {
    Route::get('/hoc-sinh/yeu-cau', [QuanLyYeuCauHocController::class, 'danhSachYeuCau'])->name('hocsinh.danh_sach_yeu_cau');
    Route::get('/hoc-sinh/tao-yeu-cau', [QuanLyYeuCauHocController::class, 'hienThiBieuMauTaoYeuCau'])->name('hocsinh.tao_yeu_cau');
    Route::post('/hoc-sinh/tao-yeu-cau', [QuanLyYeuCauHocController::class, 'taoYeuCau'])->name('hocsinh.xu_ly_tao_yeu_cau');

    Route::get('/hoc-sinh/lich-hoc', [QuanLyKetNoiController::class, 'danhSachLichHocHocSinh'])->name('hocsinh.danh_sach_lich_hoc');
    Route::post('/hoc-sinh/chap-nhan/{id}', [QuanLyKetNoiController::class, 'chapNhanLichHoc'])->name('hocsinh.chap_nhan_lich_hoc');
    Route::post('/hoc-sinh/ket-thuc/{id}', [QuanLyKetNoiController::class, 'ketThucLichHoc'])->name('hocsinh.ket_thuc_lich_hoc');
    Route::post('/hoc-sinh/danh-gia/{id}', [QuanLyKetNoiController::class, 'luuDanhGia'])->name('hocsinh.luu_danh_gia');
});

// Tim Kiem Routes
Route::get('/tim-gia-su', [TimKiemGiaSuController::class, 'trang'])->name('tim_gia_su');
Route::get('/tim-gia-su/loc', [TimKiemGiaSuController::class, 'locGiaSu'])->name('tim_gia_su.loc');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [QuanLyAdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/ho-so', [QuanLyAdminController::class, 'danhSachHoSo'])->name('danh_sach_ho_so');
    Route::post('/ho-so/duyet/{id}', [QuanLyAdminController::class, 'duyetHoSo'])->name('duyet_ho_so');
    Route::post('/ho-so/tu-choi/{id}', [QuanLyAdminController::class, 'tuChoiHoSo'])->name('tu_choi_ho_so');
});
