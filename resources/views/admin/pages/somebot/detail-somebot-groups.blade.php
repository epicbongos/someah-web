<div class="modal-header">
    <h5 class="modal-title">Detail {{ $somebot->name }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-0">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" style="width:100%;">
                            <thead>
                                <tr align="center">
                                    <th>No</th>
                                    <th>Project ID</th>
                                    <th>Branch</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($projectlist))
                                    @foreach ($projectlist as $project)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$project[1]}}</td>
                                        <td>{{$project[2]}}</td>
                                    </tr>
                                    @endforeach
                                @else
                                <tr>
                                    <td colspan="3">No Project Found!</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>

