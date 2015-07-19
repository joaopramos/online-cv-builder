@extends('admin.admin')

@section('content')
    @parent
    <div class="box col-xs-10 col-xs-offset-1">
        <div class="box-header text-center">
            Users
        </div>
        <div class="box-body">
            <table class="table table-condensed table-striped">
                <thead><tr>
                    <th> e-mail </th>
                    <th> name </th>
                    <th> account </th>
                    <th> </th>
                </tr></thead>
                <tbody>
                @foreach ($users as $item)
                    <tr>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->admin ? 'admin' : 'user' }}</td>
                        <td><a href="{{URL::to('admin/user/'.$item->id) }}"
                            data-method="delete" data-confirm="Delete user?" data-csrf="{{csrf_token()}}">
                            <span class="fa fa-trash btn btn-danger btn-xs" \></span></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
@stop
