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
                    <a href="{{ url('admin/somebot-groups') }}">Somebot - Groups</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ url('#') }}">Ubah Somebot Groups</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="mb-0">{{ $somebot->name }}</h2>
                    </div>
                    <div class="card-header">
                        <div class="col-md-12 hidden" id="InsertData">
                            <form enctype="multipart/form-data" method="POST" action="{{ url('/admin/somebot-groups/update-group/update/' . $somebot->group_id . '') }}">
                                {{ csrf_field() }}
                                <div class="row" id="form-added-1">
                                    <div class="col" style="padding-right: 0px !important; padding-left: 0px !Important;">
                                        <div class="form-group">
                                            <label for="" class="mb-2 pb-2">Ubah Group ID contoh : xxxxxx-xxxxxx@xx.xx</label><br>
                                            <input type="text" class="form-control w-100" name="group_id" id="group_id" required
                                            aria-describedby="helpId" placeholder="Group ID | xxxxxx-xxxxxx@xx.xx" value="{{ $somebot->group_id }}">
                                        </div>
                                    </div>
                                    <div class="col" style="padding-right: 0px !important; padding-left: 0px !Important;">
                                        <div class="form-group">
                                            <label for="" class="mb-2 pb-2">Ubah Group Name</label> <br>
                                            <input type="text" class="form-control w-100" name="name" id="name" required
                                                aria-describedby="helpId" placeholder="Group Name | Someah" value="{{ $somebot->name }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col" style="padding-right: 0px !important; padding-left: 0px !Important;">
                                        <div class="form-group">
                                            <label for="" class="mb-2 pb-2">Project List</label> <br>
                                            <select class="form-control w-100" multiple="multiple" id="projectslist" name="projectlist[]"></select>
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
    cursor:pointer;
    background: linear-gradient(transparent 20%, #ccc 80%);
}

.select2-container--bootstrap4.select2-container--focus .select2-selection {
    box-shadow: 0 0 0 0;
}

.select2-container--bootstrap4.select2-container--open .select2-selection {
    box-shadow: 0 0 0 0;
}

.select2-results__option[aria-selected=true] {
    display: none;
}
</style>
@endpush

@push('extras-js')
<script>
    $(document).ready(function(){
        var projectlist = $("#projectslist").select2({
            placeholder: "Select Projects",
            theme: "bootstrap4",
            allowClear: true,

            ajax: {
                url: 'update-group/getprojects',
                dataType: 'json',
                delay: 250,

                data: function (params) {
                    return {
                        // _token: CSRF_TOKEN,
                        search: params.term // search term
                    };
                },

                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });

        @if(!empty($projectlist))
            @foreach($projectlist as $value)
                var option = new Option("{{$value[1]. ' - ' .$value[2]}}","{{$value[0]}}", true, true)
                projectlist.append(option)
            @endforeach
            projectlist.trigger({type:'select2:select2'})
        @endif
    });
</script>
@endpush
