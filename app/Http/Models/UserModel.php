<?php
/**
 * Created by PhpStorm.
 * User: tannm
 * Date: 09/11/2017
 * Time: 08:18
 */
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = "users";
    protected $fillable = ['id', 'name', 'username', 'email', 'days_on'];

    /**
     * @return bool
     */
    public function isSuperAdmin()
    {
        return $this->role === 0;
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === 1;
    }
}