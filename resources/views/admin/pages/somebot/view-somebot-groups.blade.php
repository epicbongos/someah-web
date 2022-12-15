@extends('admin.layouts.layout')

@section('title', 'SomeBot Groups')

@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Somebot - Groups</h4>
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
                    <a href="{{ url('admin/somebot-projects') }}">Somebot - Groups</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="mytable" class="table table-striped table-bordered" style="width:100%;">
                                <thead>
                                    <tr align="center">
                                        <th>No</th>
                                        <th>Group ID</th>
                                        <th>Group Name</th>
                                        <th>Total Projects</th>
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

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="modal-content">
            {{-- <div class="modal-body" id="modal-body">
            </div> --}}
        </div>
    </div>
</div>
@endsection

{{-- @include('admin.pages.somebot.modal-somebot-groups') --}}

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
            ajax: 'somebot-groups/json',
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
                    data: 'group_id',
                    name: 'group_id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'total_project',
                    name: 'total_project'
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
                        url: '{{url("/admin/somebot-groups/delete-group/destroy")}}/' + id,
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

    $('body').on('click', '#btn-detail', function (event) {
        event.preventDefault();

        var me = $(this),
        url = me.attr('href')

        $.ajax({
            url: url,
            dataType: 'html',
            success: function (response) {
                $('#modal-content').html(response);
            }
        });
        $('#modal').modal('show');
    });
</script>
@endpush
