<?php
/**
 * Created by PhpStorm.
 * User: tannm
 * Date: 09/11/2017
 * Time: 09:26
 */

namespace App\Http\Controllers;

use App\Http\Models\UserModel;

class ScheduleController extends Controller
{
    private $user;
    public function __construct(UserModel $user)
    {
        $this->user = $user;
    }

    public function generate()
    {
        $users = $this->user->get();

        dd($users);
    }
}