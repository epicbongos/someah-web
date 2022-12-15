@extends('admin.layouts.layout')

@section('title')
@endsection

@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">{{ @$admin ? 'Ubah' : 'Tambah' }} Anggota Tim</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="{{ url('admin/') }}">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">{{ @$admin ? 'Ubah' : 'Tambah' }} Anggota Tim</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="mb-0">Administrator</h2>
                        </div>
                        <div class="card-body">
                            <form
                                action="{{ @$admin ? url('/admin/admin/update/' . $admin->id) : url('/admin/admin/store/') }}"
                                method="post" enctype="multipart/form-data">
                                @if (@$admin)
                                    @method('put')
                                @endif
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="name">Nama</label>
                                        <input type="text" class="form-control" value="{{ @$admin->name }}" name="name"
                                            placeholder="Nama">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="defaultSelect" role="role">Role</label>
                                        <select class="form-control form-control " name="role" id="role">
                                            <option value="admin" {{ @$admin->role == 'admin' ? 'selected' : '' }}>Admin
                                            </option>
                                            <option value="sdm" {{ @$admin->role == 'sdm' ? 'selected' : '' }}>Sumber Daya
                                                Manusia</option>
                                            <option value="superadmin"
                                                {{ @$admin->role == 'superadmin' ? 'selected' : '' }}>Super Admin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="">Email</label>
                                        <input type="email" class="form-control" value="{{ @$admin->email }}"
                                            name="email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="">Password</label>
                                        <input type="password" class="form-control" value="" name="password"
                                            placeholder="Password">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="{{ url('/admin/admin') }}" class="btn btn-warning"
                                            style="padding: 8px 30px;">Back</a>
                                        <button type="submit" class="btn btn-success"
                                            style="padding: 8px 30px;">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('extras-css')
    <style>
        .label {
            position: absolute;
            bottom: 10px;
            text-align: center;
            width: 100%;
            color: white;
            font-weight: bold;
            font-size: 14px;
        }

        .changer:hover {
            cursor: pointer;
            background: linear-gradient(transparent 20%, #ccc 80%);
        }

    </style>
@endpush

@push('extras-js')
    <script>
        $('.changer').on('click', function() {
            $('#ubahphoto').show();
            $('#ubahphoto').on('change', function() {
                var filename = $('#ubahphoto').val();
                if (filename.substring(3, 11) == 'fakepath') {
                    if (filename.length > 30) {
                        filename = filename.substring(12, 30) + '...';
                    } else {
                        filename = filename.substring(12, 30);
                    }
                }
                $('.changer').css('background', 'linear-gradient(transparent 20%, #ccc 80%)');
                $(this).prev().html(filename);
            });
        });
    </script>
@endpush
