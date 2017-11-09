@extends('layouts.main')
@section('styles-after-end')
@endsection
@section('content')
    <div class="col-xs-12">
        <br>
        <div class="clearfix"></div>
        <div class="col-md-6 col-xs-12 col-md-offset-3">
            <!-- general form elements -->
            <div class="box box-default">
                <div class="box-body text-center">
                    <a href="javascript:;" class="btn btn-primary btn-lg text-center" id="schedule-generate">Generate GotHoaQua Schedule</a>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </div>
    </div>
@endsection
@section('scripts-after-end')
    <script>
        $('document').ready(function(){
            $('#schedule-generate').on('click', function(){
                $.ajax({
                    url : "{{route('schedule.generate')}}",
                    method : "GET",
                    dataType : "JSON",
                    success: function(rs){
                        console.log(rs);
                    }
                });
            })
        });
    </script>
@endsection