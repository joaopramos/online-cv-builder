@extends('admin.admin')

@section('content')
    @parent
<form method="POST" action="{!! URL::to('/admin/template/') !!}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="box col-xs-10 col-xs-offset-1">
        <div class="box-header text-center">
            New template
        </div>
        <div class="box-body">
            <ul class="list-group">
                <li class="list-group-item">
                    <div class = "row">
                        <div class="col-xs-3">  name</div>
                        <div class="col-xs-9">
                            <input name="name" type="text" value=""> </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class = "row">
                        <div class="col-xs-3"> thumbnail </div>
                        <div class="col-xs-9"></div>
                        <div class="col-xs-12 form-group">
                            <input name="image" type="file" id="image" value="Upload" />
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class = "row">
                        <div class="col-xs-3"> template </div>
                        <div class="col-xs-9">
                            <textarea name="template" style="height:300px; width:100%"></textarea>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class = "row">
                        <div class="col-xs-3"> css  </div>
                        <div class="col-xs-9">
                            <textarea name="css" style="height:300px; width:100%"></textarea>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <button type="submit" class="btn btn-primary pull-right">
                            Create template
                        </button>
                    </div>
                </li>
            </ul>
        </div>

    </div>
</form>
@stop
