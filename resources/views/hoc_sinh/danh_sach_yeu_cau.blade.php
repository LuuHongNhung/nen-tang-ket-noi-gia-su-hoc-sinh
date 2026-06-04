@extends('layouts.app')

@section('title', 'Danh Sách Yêu Cầu')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Yêu Cầu Tìm Gia Sư</h5>
                        <a href="{{ route('hocsinh.tao_yeu_cau') }}" class="btn btn-sm btn-success">+ Tạo Yêu Cầu</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Tiêu Đề</th>
                                <th>Môn Học</th>
                                <th>Lớp</th>
                                <th>Hình Thức</th>
                                <th>Giá Dự Xuất</th>
                                <th>Trạng Thái</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($yeuCau as $yc)
                                <tr>
                                    <td>{{ $yc->tieu_de }}</td>
                                    <td>{{ $yc->monHoc->ten_mon }}</td>
                                    <td>{{ $yc->lop_hoc }}</td>
                                    <td>
                                        @if ($yc->hinh_thuc === 'truc_tuyen')
                                            Trực Tuyến
                                        @elseif ($yc->hinh_thuc === 'ngoai_tuyen')
                                            Ngoài Trường
                                        @else
                                            Kết Hợp
                                        @endif
                                    </td>
                                    <td>{{ $yc->gia_de_xuat ? number_format($yc->gia_de_xuat, 0, ',', '.') . ' VNĐ' : 'Chưa xác định' }}
                                    </td>
                                    <td>
                                        <span
                                            class="badge {{ $yc->trang_thai === 'dang_tim' ? 'bg-warning' : ($yc->trang_thai === 'da_ghep' ? 'bg-success' : 'bg-danger') }}">
                                            {{ $yc->trangThaiVietNam() }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('hocsinh.danh_sach_yeu_cau') }}" class="btn btn-sm btn-info">Chi Tiết</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if ($yeuCau->isEmpty())
                    <div class="card-body text-center">
                        <p class="text-muted">Bạn chưa có yêu cầu nào. <a href="{{ route('hocsinh.tao_yeu_cau') }}">Tạo yêu cầu
                                mới</a></p>
                    </div>
                @endif
            </div>

            {{ $yeuCau->links() }}
        </div>
    </div>
@endsection
