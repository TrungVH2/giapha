<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'password',
        'short_name',
        'name',
        'avatar',
        'gender',
        'birthday',
        'diedate_at',
        'address',
        'phone',
        'email',
        'description',
        'sort_in_family',
        'parent_id',
        'husband_wife_id',
        'branch_id',
        'layer_id',
        'roles_id',
        'user_id_add',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function branch()
    {
        return $this->belongsTo('App\Branch','branch_id');
    }

    public function getWifeOrHusband($userId)
    {
        return User::where('husband_wife_id', $userId)->get();
    }

    public  function  checkExitsEmail($email){
        return User::where('email', '=', $email)->first();
    }

    /**
     * get parent by parent id
     * @param $parentId
     * @return mixed
     */
    public function getParentByParentId($parentId)
    {
        return User::Where('id',$parentId)->OrWhere('husband_wife_id', $parentId)->get();
    }

    /**
     * Get all children of user id
     * @param $userId
     * @return mixed
     */
    public function getChildrenByUserId($userId)
    {
        return User::Where('parent_id',$userId)->get();
    }
}
