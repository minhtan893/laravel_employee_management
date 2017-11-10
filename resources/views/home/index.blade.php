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
                    <input type="text" style="visibility: hidden" name="month" id="month">
                    <a href="javascript:;" class="btn btn-primary btn-lg text-center" id="schedule-generate">Generate GotHoaQua Schedule</a>
                </div>
                <div class="box-body text-center">
                    <div id="res">

                    </div>
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
            $('#month').datepicker({
                viewMode: "months",
                minViewMode: "months"
            });
            $('#month').datepicker('show');

            $('#schedule-generate').on('click', function(){

                var month =$('input[name="month"]').val();
                if(month){
                    $.ajax({
                        url : "{{route('schedule.generate')}}",
                        method : "POST",
                        dataType : "JSON",
                        data:{
                            month : month
                        },
                        success: function(rs){
                            $('#res').empty();
                            $('#res').append(rs);
                        }
                    });
                }else{
                    $('#month').datepicker('show');
                }

            });
        });
    </script>
@endsection