@extends('admin.admin')

@section('content')
    @parent
    <div class="box col-xs-10 col-xs-offset-1">
        <div class="box-header text-center">
            Templates
            <a href="{{ URL::to('admin/template/create') }}" class="pull-right">
                <span class="fa fa-plus btn btn-default btn-xs" \> new template</span>
             </a>
        </div>
        <div class="box-body">
            <table class="table table-condensed table-striped">
                <thead><tr>
                    <th> name </th>
                    <th> thumbnail </th>
                    <th> </th>
                </tr></thead>
                <tbody>
                @foreach ($templates as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td><img src="{{URL::to('/').'/'.$item->thumbnail}}" width="100"></td>
                        <td><a href="{{URL::to('/')}}/admin/template/{{ $item->id }}">
                            <div class="fa fa-pencil btn btn-primary btn-xs"></div></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
@stop
