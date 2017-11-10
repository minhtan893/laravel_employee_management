@if($schedule[0][0]->dayOfWeek == 1)
    @for($i=0; $i< count($schedule); $i+5)

    @endfor
@else
    <?php  $week=1; ?>
    @for($i=0-($schedule[0][0]->dayOfWeek-2); $i<= count($schedule); $i =$i+5)
      {{$i}}
     <table class="table table-condensed">
         <tr>
             <th>Tuần {{$week}}</th>
             <th>Thứ 2</th>
             <th>Thứ 3</th>
             <th>Thứ 4</th>
             <th>Thứ 5</th>
             <th>Thứ 6</th>
         </tr>
         <tr>
             <th>Ngày</th>
     @for($j=$i-1;$j <$i+4 && $j < count($schedule);$j++)
         @if($j<0)
             <th></th>
         @else
             <th>{{$schedule[$j][0]->day}}</th>
         @endif
     @endfor
         </tr>
         <tr>
             <th>Người phụ trách chính</th>
     @for($j=$i-1;$j <$i+4 && $j < count($schedule);$j++)
         @if($j<0)
             <th></th>
         @else
             <th>{{$schedule[$j][1]->usernmae}}</th>
         @endif
     @endfor
         </tr>
         <tr>
             <th>Người trợ giúp</th>
     @for($j=$i-1;$j <$i+4 && $j < count($schedule);$j++)
         @if($j<0)
             <th></th>
         @else
             <th>{{$schedule[$j][1]->username}}</th>
         @endif
     @endfor
         </tr>
     </table>
     <?php $week++;  ?>
    @endfor
@endif