<?php
/**
 * Created by PhpStorm.
 * User: tannm
 * Date: 08/11/2017
 * Time: 15:30
 */

namespace App\Http\Controllers;


class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }
}