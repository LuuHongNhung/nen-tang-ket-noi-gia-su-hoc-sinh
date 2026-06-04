@extends('layouts.app')

@section('title', 'Hồ Sơ Gia Sư')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Hồ Sơ Gia Sư</h5>
                        <div>
                            <a href="{{ route('giasu.chinh_sua_ho_so') }}" class="btn btn-sm btn-warning">Chỉnh Sửa</a>
                            <form method="POST" action="{{ route('giasu.xoa_ho_so') }}" class="d-inline"
                                onsubmit="return confirm('Bạn chắc chắn muốn xóa?');">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-3 text-center">
                            <img src="{{ $hoSo->taiKhoan->getDuongDanAvatarAttribute() }}" alt="Avatar"
                                class="rounded-circle" style="width: 150px; height: 150px;">
                            <h5 class="mt-3">{{ $hoSo->taiKhoan->ho_ten }}</h5>
                        </div>
                        <div class="col-md-9">
                            <table class="table table-borderless">
                                <tr>
                                    <th>Chuyên Môn:</th>
                                    <td><strong>{{ $hoSo->chuyen_mon }}</strong></td>
                                </tr>
                                <tr>
                                    <th>Hình Thức Dạy:</th>
                                    <td>
                                        @if ($hoSo->hinh_thuc_day === 'truc_tuyen')
                                            Trực Tuyến
                                        @elseif ($hoSo->hinh_thuc_day === 'ngoai_tuyen')
                                            Ngoài Trường
                                        @else
                                            Kết Hợp
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tiền Lương:</th>
                                    <td><strong>{{ number_format($hoSo->tien_luong_gio_cong, 0, ',', '.') }}</strong> VNĐ/Giờ
                                    </td>
                                </tr>
                                <tr>
                                    <th>Địa Chỉ Dạy:</th>
                                    <td>{{ $hoSo->dia_chi_day ?? 'Chưa cập nhật' }}</td>
                                </tr>
                                <tr>
                                    <th>Trạng Thái:</th>
                                    <td>
                                        <span
                                            class="badge {{ $hoSo->trang_thai === 'da_duyet' ? 'bg-success' : ($hoSo->trang_thai === 'tu_choi' ? 'bg-danger' : 'bg-warning') }}">
                                            {{ $hoSo->trangThaiVietNam() }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Đánh Giá:</th>
                                    <td>
                                        ⭐ {{ $hoSo->danh_gia_trung_binh }}/5.0
                                        ({{ $hoSo->so_luot_danh_gia }} lượt)
                                    </td>
                                </tr>
                                <tr>
                                    <th>Giờ Dạy:</th>
                                    <td>{{ $hoSo->so_gio_da_day }} giờ</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <hr>

                    <h6 class="mb-3"><strong>Bằng Cấp / Chứng Chỉ:</strong></h6>
                    <p>{{ $hoSo->bang_cap }}</p>

                    <h6 class="mb-3"><strong>Kinh Nghiệm Giảng Dạy:</strong></h6>
                    <p>{{ $hoSo->kinh_nghiem }}</p>

                    <h6 class="mb-3"><strong>Giới Thiệu:</strong></h6>
                    <p>{{ $hoSo->gioi_thieu ?? 'Chưa cập nhật' }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
