@if($schedule[0][0]->dayOfWeek == 1)
        <?php $limit = 0;  ?>
@else
    <?php  $limit = 0-($schedule[0][0]->dayOfWeek-2); ?>
@endif
<div class="col-xs-12 col-md-8 col-md-offset-2">
    <h2 class="text-blue">{{ $thisMonth->month }} - {{ $thisMonth->year }}</h2>
    <table id="calendar" class="table">
        <tr class="weekdays">
            <th scope="col">Monday</th>
            <th scope="col">Tuesday</th>
            <th scope="col">Wednesday</th>
            <th scope="col">Thursday</th>
            <th scope="col">Friday</th>
        </tr>
        @for($i=$limit; $i<= count($schedule); $i =$i+5)
            <tr class="days">
                @for($j=$i-1;$j <$i+4 && $j < count($schedule);$j++)
                    @if($j<0)
                        <td class="day other-month">

                        </td>
                    @else
                        <td class="day other-month">
                            <div class="date">{{$schedule[$j][0]->day}}</div>
                            <div class="event">
                                <div class="event-desc">
                                    <a href="{{route('user.detail',['id'=>$schedule[$j][1]->user_id])}}">{{$schedule[$j][1]->username}}</a>
                                    <br>
                                    <a href="{{route('user.detail',['id'=>$schedule[$j][2]->user_id])}}">{{$schedule[$j][2]->username}}</a>
                                </div>
                                <div class="event-time">
                                </div>
                            </div>
                        </td>
                    @endif
                @endfor
            </tr>
        @endfor
    </table>
</div>



