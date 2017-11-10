<?php
/**
 * Created by PhpStorm.
 * User: tannm
 * Date: 09/11/2017
 * Time: 13:31
 */

namespace App\Http\Models;


use Carbon\Carbon;
use Illuminate\Support\Collection;

class ScheduleModel
{
    public $user_id;
    public $username;
    public $days_on;
    public $days_limit;//gothoaqua max
    public $days_max = 20;//4days/week
    public $daysGHQ ;

    public function __construct(UserModel $user, Collection $days_on, $days_limit)
    {
        $this->user_id = $user->id;
        $this->username = $user->username;
        $this->days_limit = $days_limit;
        $this->daysGHQ = new Collection();
        for ($i=0; $i< $days_on->count();$i++){
            if($days_on[$i]->dayOfWeek == 0 || $days_on[$i]->dayOfWeek == 6){
                $days_on->forget($i);
            }
        }
        $this->days_on = $days_on;
    }

    /**
     * @param ScheduleModel $schedule
     * @return bool
     */
    public function checkLimitForMember(){
        if($this->daysGHQ->count() <= $this->days_limit -1 ) return true;
          return false;
    }

    /**
     * @param Carbon $day
     * @return bool
     */
    public function checkExistDayForMember(Carbon $day)
    {
        if($this->checkLimitForMember() === false) return false;
        $hasDay = $this->days_on->filter(function($item) use ($day) {
            return $item->day === $day->day;
        });
        $beforeDay = $this->daysGHQ->filter(function($item) use ($day){
            return $item['day']->day === $day->day-1;
        });
        if($beforeDay->count()) return false;
        $beforeDay = $this->daysGHQ->filter(function($item) use ($day){
            return $item['day']->day === $day->day-2;
        });
        if($beforeDay->count()) return false;
        if($hasDay->count()){
            return true;
        }

        return false;
    }

    public function checkExistFriend($friend_id)
    {
        $daysGHOed = count($this->daysGHQ);

        if($daysGHOed >5){
            $limit = 5;
        }else if($daysGHOed == 0){
            return true;
        }else{
            $limit = $daysGHOed -1;
        }
        for ($i = $limit; $i > 0; $i--){
                if($this->daysGHQ[$i]['friend_id'] === $friend_id){
                    return false;
                }
         }

        return true;
    }

    /**
     * @param Carbon $day
     * @param $id
     */
    public function choised(Carbon $day,$id)
    {
        $this->daysGHQ->push(["day" => $day, "friend_id" => $id]);
    }

}
