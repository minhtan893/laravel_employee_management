@extends('layouts.main')
@section('styles-after-end')
    <style>
        #calendar {
            max-width: 100%;
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            padding: 20px 0px;
        }

        #calendar tr, #calendar tbody {
            grid-column: 1 / -1;
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            width: 100%;
        }

        caption {
            text-align: center;
            grid-column: 1 / -1;
            font-size: 130%;
            font-weight: bold;
            padding: 10px 0;
        }

        #calendar a {
            display: block;
            color: #001f3f;
            font-weight:500;
            font-size: 18px;
            text-decoration: none;
        }

        #calendar td, #calendar th {
            padding: 5px;
            box-sizing:border-box;
            border: 1px solid #ccc;
        }

        #calendar .weekdays {
            background: #00c0ef;
        }


        #calendar .weekdays th {
            text-align: center;
            text-transform: uppercase;
            line-height: 20px;
            border: none !important;
            padding: 10px 6px;
            color: #fff;
            font-size: 13px;
        }

        #calendar td {
            min-height: 138px;
            display: flex;
            flex-direction: column;
        }

        #calendar .days li:hover {
            background: #d3d3d3;
        }

        #calendar .date {
            text-align: center;
            margin-bottom: 5px;
            padding: 4px;
            background: #333;
            color: #fff;
            width: 20px;
            font-weight: 400;
            line-height: 1;
            border-radius: 50%;
            flex: 0 0 auto;
            align-self: flex-end;
        }

        #calendar .event {
            margin-top: 5px;
            flex: 0 0 auto;
            font-size: 13px;
            border-radius: 4px;
            padding: 5px;
            margin-bottom: 5px;
            line-height: 14px;
            color: #009aaf;
            text-decoration: none;
        }

        #calendar .event-desc {
            color: #666;
            margin: 3px 0 7px 0;
            text-decoration: none;
        }

        #calendar .other-month {
            color: #666;
        }

        /* ============================
                        Mobile Responsiveness
           ============================*/


        @media(max-width: 768px) {

            #calendar .weekdays, #calendar .other-month {
                display: none;
            }

            #calendar li {
                height: auto !important;
                border: 1px solid #ededed;
                width: 100%;
                padding: 10px;
                margin-bottom: -1px;
            }

            #calendar, #calendar tr, #calendar tbody {
                grid-template-columns: 1fr;
            }

            #calendar  tr {
                grid-column: 1 / 2;
            }

            #calendar .date {
                align-self: flex-start;
            }
        }
    </style>
@endsection
@section('content')
    <div class="col-xs-12">
        <br>
        <div class="clearfix"></div>
        <div class=" col-xs-12 ">
            <!-- general form elements -->
            <div class="box box-default">
                <div class="box-body text-center">
                    <a href="javascript:;" class="btn btn-primary btn-lg text-center" id="schedule-generate">Generate GotHoaQua Schedule</a>
                    <input type="text" style="visibility: hidden" name="month" id="month">
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
    @include('loading_modal')
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
                    $('.modal').modal('hide');
                    $('.loading-modal').modal('show');
                    $.ajax({
                        url : "{{route('schedule.generate')}}",
                        method : "POST",
                        dataType : "JSON",
                        data:{
                            month : month
                        },
                        success: function(rs){
                            $('.modal').modal('hide');
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