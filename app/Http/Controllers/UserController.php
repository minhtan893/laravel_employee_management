<?php
/**
 * Created by PhpStorm.
 * User: tannm
 * Date: 08/11/2017
 * Time: 15:42
 */

namespace App\Http\Controllers;


use App\Http\Models\UserModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $user;
    /*
     * */
    public function __construct(UserModel $user)
    {
        $this->user = $user;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = $this->user->get();
        return view('user.index',['users' => $users]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('user.create');
    }

    public function save(Request $request)
    {
        if($request['id']){
            $currentUser = $this->user->find($request['id']);
            if(!$currentUser) abort(404);
            $validator = \Validator::make($request->all(), [
                'name' => 'required',
                'username' => 'required|unique:users,username,'.$currentUser->id,
                'email' => 'required|unique:users,email,'.$currentUser->id
            ]);
        }else{
            $validator = \Validator::make($request->all(), [
                'name' => 'required',
                'username' => 'required|unique:users',
                'email' => 'required|unique:users'
            ]);
        }
        if($validator->fails()) return redirect()->back()->withErrors($validator->errors())->withInput();
        $request['id'] ? $currentUser->update($request->all()) : $this->user->create($request->all());

        return redirect()->route('user.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function detail($id)
    {
        $user = $this->user->find($id);
        if(!$user) return abort(404);

        return view('user.edit', ['user' => $user]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $user = $this->user->findOrFail($id);

        $user->delete();
        return redirect()->route('user.index');
    }
}