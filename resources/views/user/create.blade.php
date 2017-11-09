@extends('layouts.main')
@section('styles-after-end')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{url('public/bower_components/datatables.net-bs/css/dataTables.bootstrap.css')}}">
@endsection
@section('content')
    <div class="col-xs-12">
        <br>
        <div class="clearfix"></div>
        <div class="col-md-6 col-xs-12 col-md-offset-3">
            <!-- general form elements -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Create member</h3>
                </div>
                <div class="box-body">
                    <form action="{{route('user.save')}}" method="POST">
                        {{csrf_field()}}
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="event_name">*Full name</label>
                            <input type="text" class="form-control" required name="name" value="{{  old('name') }}">
                            @if ($errors->has('name'))
                                <span class="help-block">
                          <strong>{{ $errors->first('name') }}</strong>
                    </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="event_name">*Username</label>
                            <input type="text" class="form-control" required name="username" value="{{  old('username') }}">
                            @if ($errors->has('username'))
                                <span class="help-block">
                          <strong>{{ $errors->first('username') }}</strong>
                    </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="event_name">*Email</label>
                            <input type="email" class="form-control" required name="email" value="{{  old('email') }}">
                            @if ($errors->has('email'))
                                <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="event_name">*Days on</label>
                            <br>
                            <a href="javascript:;" onclick="showCalender()" class="btn btn-default">Choise</a>
                            <input type="text" style="visibility: hidden;" class="form-control" id="days_on" name="days_on" value="">
                        </div>
                        <div class="form-group">
                            <a href="{{route('user.index')}}" class="btn btn-default pull-left"><i class="fa fa-hand-o-left fa-previous"></i></a>
                            <button type="submit" class="btn btn-primary pull-right">Save</button>
                        </div>

                    </form>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </div>
    </div>
@endsection
@section('scripts-after-end')
    <script src="{{url('public/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script>
        $('document').ready(function(){
            $('#example2').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            });
            $('#days_on').datepicker({
                'multidate': true,
                "autoclose" : false
            });
        });
    </script>
@endsection