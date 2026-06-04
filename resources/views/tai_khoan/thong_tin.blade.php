@extends('layouts.app')

@section('title', 'Thông Tin Tài Khoản')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Thông Tin Tài Khoản</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3 text-center">
                            <img src="{{ Auth::user()->getDuongDanAvatarAttribute() }}" alt="Avatar"
                                class="rounded-circle" style="width: 150px; height: 150px;">
                        </div>
                        <div class="col-md-9">
                            <table class="table table-borderless">
                                <tr>
                                    <th>Họ Tên:</th>
                                    <td>{{ $taiKhoan->ho_ten }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $taiKhoan->email }}</td>
                                </tr>
                                <tr>
                                    <th>Số Điện Thoại:</th>
                                    <td>{{ $taiKhoan->so_dien_thoai }}</td>
                                </tr>
                                <tr>
                                    <th>Địa Chỉ:</th>
                                    <td>{{ $taiKhoan->dia_chi ?? 'Chưa cập nhật' }}</td>
                                </tr>
                                <tr>
                                    <th>Vai Trò:</th>
                                    <td>
                                        @if ($taiKhoan->vai_tro === 'admin')
                                            <span class="badge bg-danger">Admin</span>
                                        @elseif ($taiKhoan->vai_tro === 'gia_su')
                                            <span class="badge bg-info">Gia Sư</span>
                                        @else
                                            <span class="badge bg-success">Học Sinh</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Trạng Thái:</th>
                                    <td>
                                        @if ($taiKhoan->trang_thai === 'hoat_dong')
                                            <span class="badge bg-success">Hoạt Động</span>
                                        @else
                                            <span class="badge bg-danger">Bị Khóa</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Cập Nhật Thông Tin</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('tai_khoan.cap_nhat') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="ho_ten" class="form-label">Họ Tên</label>
                            <input type="text" class="form-control @error('ho_ten') is-invalid @enderror"
                                id="ho_ten" name="ho_ten" value="{{ old('ho_ten', $taiKhoan->ho_ten) }}" required>
                            @error('ho_ten')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="so_dien_thoai" class="form-label">Số Điện Thoại</label>
                            <input type="text" class="form-control @error('so_dien_thoai') is-invalid @enderror"
                                id="so_dien_thoai" name="so_dien_thoai"
                                value="{{ old('so_dien_thoai', $taiKhoan->so_dien_thoai) }}" required>
                            @error('so_dien_thoai')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="dia_chi" class="form-label">Địa Chỉ</label>
                            <input type="text" class="form-control @error('dia_chi') is-invalid @enderror"
                                id="dia_chi" name="dia_chi" value="{{ old('dia_chi', $taiKhoan->dia_chi) }}">
                            @error('dia_chi')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Cập Nhật</button>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Đổi Mật Khẩu</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('tai_khoan.doi_mat_khau') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="mat_khau_cu" class="form-label">Mật Khẩu Cũ</label>
                            <input type="password" class="form-control @error('mat_khau_cu') is-invalid @enderror"
                                id="mat_khau_cu" name="mat_khau_cu" required>
                            @error('mat_khau_cu')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="mat_khau_moi" class="form-label">Mật Khẩu Mới</label>
                            <input type="password" class="form-control @error('mat_khau_moi') is-invalid @enderror"
                                id="mat_khau_moi" name="mat_khau_moi" required>
                            @error('mat_khau_moi')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="mat_khau_moi_confirmation" class="form-label">Xác Nhận Mật Khẩu Mới</label>
                            <input type="password"
                                class="form-control @error('mat_khau_moi_confirmation') is-invalid @enderror"
                                id="mat_khau_moi_confirmation" name="mat_khau_moi_confirmation" required>
                            @error('mat_khau_moi_confirmation')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Đổi Mật Khẩu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
