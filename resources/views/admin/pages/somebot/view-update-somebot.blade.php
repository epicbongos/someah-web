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
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ url('#') }}">Ubah Somebot Projects</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="mb-0">{{ $somebot->project_id }}</h2>
                    </div>
                    <div class="card-header">
                        <div class="col-md-12 hidden" id="InsertData">
                            <form enctype="multipart/form-data" method="POST" action="{{ url('/admin/somebot-projects/update-project/update/' . $somebot->id . '') }}">
                                {{ csrf_field() }}
                                <div class="row" id="form-added-1">
                                    <div class="col"
                                        style="padding-right: 0px !important; padding-left: 0px !Important;">
                                        <div class="form-group">
                                            <label for="" class="mb-2 pb-2">Ubah Project URL contoh : https://gitlab.com/<b>someah/someah-web</b></label> <br>
                                            <input type="text" class="form-control w-100" name="project_id" id="project_id" required
                                            aria-describedby="helpId" placeholder="ProjectName | someah/someah_web" value="{{ $somebot->project_id }}">
                                        </div>
                                    </div>
                                    <div class="col" style="padding-right: 0px !important; padding-left: 0px !Important;">
                                        <div class="form-group">
                                            <label for="" class="mb-2 pb-2">Ubah Branch Project</label> <br>
                                            <input type="text" class="form-control w-100" name="ref" id="ref" required
                                                aria-describedby="helpId" placeholder="Branch Project | master" value="{{ $somebot->ref }}">
                                        </div>
                                    </div>
                                    <div class="col" style="padding-left: 0px !Important;">
                                        <div class="form-group">
                                            <label for="" class="mb-2 pb-2">Ubah Token Project</label> <br>
                                            <input type="text" class="form-control w-100" name="token" id="token" required
                                                aria-describedby="helpId" placeholder="Token Project | 000000000000000000" value="{{ $somebot->token }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-end d-flex mb-2">
                                    <button type="submit" class="btn btn-success mr-4" id="submit">
                                        <span class="btn-label pr-1">
                                            <i class="fas fa-save"></i>
                                        </span>
                                        Update
                                    </button>
                                </div>
                            </form>
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

.label
{
    position: absolute;
    bottom: 10px;
    text-align: center;
    width: 100%;
    color: white;
    font-weight: bold;
    font-size: 14px;
}

.changer:hover
{
    cursor:pointer;
    background: linear-gradient(transparent 20%, #ccc 80%);
}

</style>
@endpush
