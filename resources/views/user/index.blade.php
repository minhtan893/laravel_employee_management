@extends('layouts.main')
@section('styles-after-end')
    <!-- DataTables -->

    <link rel="stylesheet" href="{{url('public/bower_components/datatables.net-bs/css/dataTables.bootstrap.css')}}">
@endsection
@section('content')
    <div class="col-xs-12">
        <a href="{{route('user.create')}}" class="btn btn-default pull-right"><i class="fa fa-plus"></i></a>
        @if($users->count())
        <table id="example2" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
            </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td><a href="{{route('user.detail' ,['id' => $user->id])}}">{{ $user->name }}</a></td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <h2>No member</h2>
        @endif
    </div>
@endsection
@section('scripts-after-end')
    <script src="{{url('public/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script>
        $('document').ready(function(){
            $('#example2').DataTable({
                'paging'      : false,
                'lengthChange': false,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : true
            })
        });
    </script>
@endsection