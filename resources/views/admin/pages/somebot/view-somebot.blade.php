@extends('admin.layouts.layout')

@section('title', 'SomeBot Projects')

@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Somebot - Projects</h4>
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
                    <a href="{{ url('admin/somebot-projects') }}">Somebot - Projects</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{-- <a href="{{ url('/admin/somebot-projects/insert-project') }}" class="btn btn-success" id="showInsertDataB">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Tambah Projects
                        </a> --}}
                        <button type="button" id="showInsertDataB" class="btn btn-success" onclick="toogleAddData()"><i class="fa fa-plus"></i></span>  Tambah Projects</button>
                        <div class="col-md-12 hidden" id="InsertData">
                            <form enctype="multipart/form-data" method="POST" action="{{ url('/admin/somebot-projects/insert-project/store') }}">
                                {{ csrf_field() }}
                                <div class="row" id="form-added-1">
                                    <div class="col"
                                        style="padding-right: 0px !important; padding-left: 0px !Important;">
                                        <div class="form-group">
                                            <label for="" class="mb-2 pb-2">Masukkan Project URL contoh : https://gitlab.com/<b>someah/someah-web</b></label> <br>
                                            <input type="text" class="form-control w-100" name="project_id" id="project_id" required
                                        aria-describedby="helpId" placeholder="ProjectName | someah/someah_web" value="{{ old('name.0') }}">
                                        @if($errors->has('name.0'))
                                        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                            {{ $errors->first('name.0') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="col" style="padding-right: 0px !important; padding-left: 0px !Important;">
                                        <div class="form-group">
                                            <label for="" class="mb-2 pb-2">Masukan Branch Project</label> <br>
                                            <input type="text" class="form-control w-100" name="ref" id="ref" required
                                                aria-describedby="helpId" placeholder="Branch Project | master" value="{{ old('branch.0') }}">
                                                @if($errors->has('branch.0'))
                                                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                                    {{ $errors->first('branch.0') }}
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                @endif
                                        </div>
                                    </div>
                                    <div class="col" style="padding-left: 0px !Important;">
                                        <div class="form-group">
                                            <label for="" class="mb-2 pb-2">Masukan Token Project</label> <br>
                                            <input type="text" class="form-control w-100" name="token" id="token" required
                                                aria-describedby="helpId" placeholder="Token Project | 000000000000000000" value="{{ old('token.0') }}">
                                                @if($errors->has('token.0'))
                                                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                                    {{ $errors->first('token.0') }}
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-end d-flex mb-2">
                                    <button type="submit" class="btn btn-success mr-4" id="submit">
                                        <span class="btn-label pr-1">
                                            <i class="fas fa-save"></i>
                                        </span>
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="mytable" class="table table-striped table-bordered" style="width:100%;">
                                <thead>
                                    <tr align="center">
                                        <th>No</th>
                                        <th>Projects</th>
                                        <th>Branch</th>
                                        <th>Token</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('extras-css')
<style>
    .clearfix {
        clear: both;
    }

    tbody>tr {
        text-align: center;
    }

    tbody>tr>td:last-child {
        justify-content: center;
        align-items: center;
        display: flex;
    }

    .custom-select
    {
        width: 45% !important;
    }

    .hidden{
        display: none;
    }
</style>
@endpush

@push('extras-js')
<script>
    $(function () {
        $('#mytable').DataTable({
            processing: true,
            serverSide: true,
            ajax: 'somebot-projects/json',
            columns: [{
                    data: 'id',
                    name: 'id',
                    render: function (data, type, row, meta) {
                        if (data == 0)
                        {
                        } else {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    }
                },
                {
                    data: 'project_id',
                    name: 'project_id'
                },
                {
                    data: 'ref',
                    name: 'ref'
                },
                {
                    data: 'token',
                    name: 'token'
                },
                {
                    data: 'aksi',
                    name: 'aksi'
                }
            ]
        });
    });

    function deleteData(id) {
        try {
            swal({
                title: "Hapus",
                text: "Apakah anda yakin?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{url("/admin/somebot-projects/delete-project/destroy")}}/' + id,
                        type: 'POST',
                        success: function (data) {
                            swal("Data Berhasil Dihapus!", {
                                icon: "success",
                            });
                            $('#mytable').DataTable().ajax.reload();
                        },
                        error: function (err) {
                            console.log(err);
                        }
                    })
                } else {
                    swal("Data Gagal Dihapus!", {
                        icon: "error",
                    });
                }
            });
        } catch (error) {
            console.log(error);
        }
    }

    function toogleAddData(){
        var x = document.getElementById("InsertData");
        if(x.style.display === "block"){
            x.style.display = "none";
        }else{
            x.style.display = "block";
        }
    }
</script>
@endpush
