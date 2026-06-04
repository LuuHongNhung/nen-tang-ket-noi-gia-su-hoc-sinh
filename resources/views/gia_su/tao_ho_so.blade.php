@extends('layouts.app')

@section('title', 'Tạo Hồ Sơ Gia Sư')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Tạo Hồ Sơ Gia Sư</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('giasu.xu_ly_tao_ho_so') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="chuyen_mon" class="form-label">Chuyên Môn</label>
                            <input type="text" class="form-control @error('chuyen_mon') is-invalid @enderror"
                                id="chuyen_mon" name="chuyen_mon" placeholder="Ví dụ: Toán, Văn, Tiếng Anh..."
                                required>
                            @error('chuyen_mon')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="bang_cap" class="form-label">Bằng Cấp / Chứng Chỉ</label>
                            <textarea class="form-control @error('bang_cap') is-invalid @enderror" id="bang_cap"
                                name="bang_cap" rows="3" placeholder="Mô tả bằng cấp, chứng chỉ của bạn..." required></textarea>
                            @error('bang_cap')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kinh_nghiem" class="form-label">Kinh Nghiệm Giảng Dạy</label>
                            <textarea class="form-control @error('kinh_nghiem') is-invalid @enderror"
                                id="kinh_nghiem" name="kinh_nghiem" rows="3"
                                placeholder="Mô tả kinh nghiệm giảng dạy của bạn..." required></textarea>
                            @error('kinh_nghiem')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tien_luong_gio_cong" class="form-label">Tiền Lương (VNĐ/Giờ)</label>
                            <input type="number" class="form-control @error('tien_luong_gio_cong') is-invalid @enderror"
                                id="tien_luong_gio_cong" name="tien_luong_gio_cong" placeholder="Ví dụ: 100000"
                                step="1000" required>
                            @error('tien_luong_gio_cong')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="hinh_thuc_day" class="form-label">Hình Thức Dạy</label>
                            <select class="form-select @error('hinh_thuc_day') is-invalid @enderror"
                                id="hinh_thuc_day" name="hinh_thuc_day" required>
                                <option value="">Chọn hình thức dạy</option>
                                <option value="truc_tuyen">Trực Tuyến</option>
                                <option value="ngoai_tuyen">Ngoài Trường</option>
                                <option value="ket_hop">Kết Hợp</option>
                            </select>
                            @error('hinh_thuc_day')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="dia_chi_day" class="form-label">Địa Chỉ Dạy (Nếu Có)</label>
                            <input type="text" class="form-control @error('dia_chi_day') is-invalid @enderror"
                                id="dia_chi_day" name="dia_chi_day" placeholder="Địa chỉ dạy ngoài trường">
                            @error('dia_chi_day')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gioi_thieu" class="form-label">Giới Thiệu Bản Thân</label>
                            <textarea class="form-control @error('gioi_thieu') is-invalid @enderror"
                                id="gioi_thieu" name="gioi_thieu" rows="3" placeholder="Giới thiệu về bạn..."></textarea>
                            @error('gioi_thieu')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Tạo Hồ Sơ</button>
                        <a href="{{ route('trang_chu') }}" class="btn btn-secondary">Hủy</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
