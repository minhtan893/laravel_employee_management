<?php
/**
 * Created by PhpStorm.
 * User: tannm
 * Date: 09/11/2017
 * Time: 09:26
 */

namespace App\Http\Controllers;

use App\Http\Models\ScheduleModel;
use App\Http\Models\UserModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ScheduleController extends Controller
{
    private $days_max = 21;
    private $max_turn = 0;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function generate(Request $request)
    {
        $users = UserModel::get();
        $turn_avg = round(42/$users->count())  ;
        $thisMonth = new Carbon($request['month']);
        $days = $this->getWorkDays($thisMonth);
        $schedules = $this->createSchedules($users, $thisMonth->month, $turn_avg);
        $monthSchedule = [];
        foreach ($days as $day){
            $daySchedule  = $this->createRandom($day, $schedules);

            if(count($daySchedule)){
                array_push($monthSchedule,[$day,$daySchedule[0],$daySchedule[1]]);
            }
        }

        $view = view('schedule', ['schedule'=>$monthSchedule])->render();

        return response()->json($view);

    }

    /**
     * @param Collection $users
     * @param $month
     * @param $turn_avg
     * @return []
     */
    private function createSchedules(Collection $users, $month, $turn_avg){
        $schedules = [];
        if($users->count()){
            foreach ($users as $user) {
                $days = new Collection();
                $days_on = explode(",", $user->days_on);
                foreach ($days_on as $day) {
                    $d = new Carbon($day);
                    if($d->month === $month){
                        $days->push($d);
                    }
                }

                $schedule = new ScheduleModel($user, $days, count($days_on));
                array_push($schedules, $schedule);
            }
        }
        return $schedules;
    }

    /**
     * @param $month
     * @return array
     */
    private function getWorkDays($month){
        $daysInMonth  = cal_days_in_month(CAL_GREGORIAN, $month->month, $month->year);
        $days = [];
        for($i = 1; $i <= $daysInMonth;$i++){
            $d = new  Carbon($month->month."/".$i."/".$month->year);
            if($d->dayOfWeek != 0 && $d->dayOfWeek != 6){
                array_push($days, $d);
            }
        }
        return $days;
    }

    /**
     * @param Carbon $day
     * @param array $schedules
     * @return array
     */
    private function createRandom(Carbon $day, array $schedules){
        $members = $this->getMembersHasThatDay($day, $schedules , false);
        if(count($members) <2){
           return $this->createRandom($day, $schedules, true);
        }else{
            $randoms = array_rand($members ,2);
        }
        $checkAll = $members[$randoms[1]]->checkExistFriend($members[$randoms[0]]->user_id);
        if($checkAll == false){
            if($this->max_turn <= 500){
                $this->max_turn++;
                return $this->createRandom($day, $schedules);
            }
        }
         $schedules[$randoms[0]]->choised($day, $schedules[$randoms[1]]->user_id);
         $schedules[$randoms[1]]->choised($day, $schedules[$randoms[0]]->user_id);
        return [$schedules[$randoms[0]],$schedules[$randoms[1]]];
    }

    /**
     * @param Carbon $day
     * @param array $schedules
     * @return array
     */
    private function getMembersHasThatDay(Carbon $day, array $schedules, $except = false ){
       return array_filter($schedules, function($item) use($day, $except){
            $hasDay =  $item->checkLimitForMember();
            if($hasDay){
                return $item;
            }
       });
    }
}