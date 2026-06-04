@extends('layouts.app')

@section('title', 'Tạo Yêu Cầu Học')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Tạo Yêu Cầu Tìm Gia Sư</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('hocsinh.xu_ly_tao_yeu_cau') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="mon_hoc_id" class="form-label">Môn Học</label>
                            <select class="form-select @error('mon_hoc_id') is-invalid @enderror"
                                id="mon_hoc_id" name="mon_hoc_id" required>
                                <option value="">Chọn môn học</option>
                                @foreach ($monHoc as $mon)
                                    <option value="{{ $mon->id }}" {{ old('mon_hoc_id') == $mon->id ? 'selected' : '' }}>
                                        {{ $mon->ten_mon }}
                                    </option>
                                @endforeach
                            </select>
                            @error('mon_hoc_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tieu_de" class="form-label">Tiêu Đề</label>
                            <input type="text" class="form-control @error('tieu_de') is-invalid @enderror"
                                id="tieu_de" name="tieu_de" placeholder="Ví dụ: Cần học toán chuẩn bị thi..."
                                value="{{ old('tieu_de') }}" required>
                            @error('tieu_de')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="mo_ta" class="form-label">Mô Tả Chi Tiết</label>
                            <textarea class="form-control @error('mo_ta') is-invalid @enderror" id="mo_ta"
                                name="mo_ta" rows="4" placeholder="Mô tả yêu cầu của bạn..." required>{{ old('mo_ta') }}</textarea>
                            @error('mo_ta')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="lop_hoc" class="form-label">Lớp Học</label>
                            <input type="text" class="form-control @error('lop_hoc') is-invalid @enderror"
                                id="lop_hoc" name="lop_hoc" placeholder="Ví dụ: Lớp 12A1" value="{{ old('lop_hoc') }}"
                                required>
                            @error('lop_hoc')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="hinh_thuc" class="form-label">Hình Thức Học</label>
                            <select class="form-select @error('hinh_thuc') is-invalid @enderror" id="hinh_thuc"
                                name="hinh_thuc" required>
                                <option value="">Chọn hình thức</option>
                                <option value="truc_tuyen" {{ old('hinh_thuc') === 'truc_tuyen' ? 'selected' : '' }}>
                                    Trực Tuyến
                                </option>
                                <option value="ngoai_tuyen" {{ old('hinh_thuc') === 'ngoai_tuyen' ? 'selected' : '' }}>
                                    Ngoài Trường
                                </option>
                                <option value="ket_hop" {{ old('hinh_thuc') === 'ket_hop' ? 'selected' : '' }}>
                                    Kết Hợp
                                </option>
                            </select>
                            @error('hinh_thuc')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="dia_chi_hoc" class="form-label">Địa Chỉ Học (Nếu Học Ngoài)</label>
                            <input type="text" class="form-control @error('dia_chi_hoc') is-invalid @enderror"
                                id="dia_chi_hoc" name="dia_chi_hoc" value="{{ old('dia_chi_hoc') }}">
                            @error('dia_chi_hoc')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="so_buoi_tuan" class="form-label">Số Buổi/Tuần</label>
                            <input type="number" class="form-control @error('so_buoi_tuan') is-invalid @enderror"
                                id="so_buoi_tuan" name="so_buoi_tuan" value="{{ old('so_buoi_tuan', 1) }}" min="1"
                                required>
                            @error('so_buoi_tuan')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gia_de_xuat" class="form-label">Giá Dự Xuất (VNĐ/Giờ)</label>
                            <input type="number" class="form-control @error('gia_de_xuat') is-invalid @enderror"
                                id="gia_de_xuat" name="gia_de_xuat" value="{{ old('gia_de_xuat') }}" step="1000">
                            @error('gia_de_xuat')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Tạo Yêu Cầu</button>
                        <a href="{{ route('hocsinh.danh_sach_yeu_cau') }}" class="btn btn-secondary">Hủy</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
