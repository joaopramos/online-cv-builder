@extends('admin.admin')

@section('content')
    @parent
<form method="POST" action="{!! URL::to('/admin/template/'.$template->id) !!}"
    enctype="multipart/form-data">
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="box col-xs-10 col-xs-offset-1">
        <div class="box-header text-center">
            Template: {{ $template->name }}
            <a href="/admin/template/{{ $template->id }}"
                data-method="delete" data-confirm="Delete template?" data-csrf="{{csrf_token()}}">
                <span class="fa fa-trash btn btn-danger btn-xs" \></span>
            </a>
        </div>
        <div class="box-body">
            <ul class="list-group">
                <li class="list-group-item">
                    <div class = "row">
                        <div class="col-xs-3"> id </div>
                        <div class="col-xs-9"> {{ $template->id }} </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class = "row">
                        <div class="col-xs-3">  name</div>
                        <div class="col-xs-4">
                            <input name="name" type="text" value="{{ $template->name }}"> </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class = "row">
                        <div class="col-xs-3"> thumbnail </div>
                        <div class="col-xs-9"><img src="{{$template->thumbnail}}" width="100"></div>
                        <div class="col-xs-12 form-group {{{ $errors->has('image') ? 'error' : '' }}}">
                            <input name="image" type="file" accept="image/*" />
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class = "row">
                        <div class="col-xs-3"> template </div>
                        <div class="col-xs-9">
                            <textarea name="template" style="height:300px; width:100%">{{$template->template}}</textarea>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class = "row">
                        <div class="col-xs-3"> css  </div>
                        <div class="col-xs-9">
                            <textarea name="css" style="height:300px; width:100%">{{$template->css}}</textarea>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <button type="submit" class="btn btn-primary pull-right">
                            Update
                        </button>
                    </div>
                </li>
            </ul>
        </div>

    </div>
</form>
@stop
