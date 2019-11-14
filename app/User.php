<?php

namespace App;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function documentations()
    {
        return $this->hasMany('App\Documentation');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function getRoleNames()
    {
        $result=[];
        foreach($this->roles as $role) {
            array_push($result, $role->name);
        }
        return $result;
    }

    public function getPermissionNames() {
        $result=[];
        foreach($this->roles as $role) {
            $result=array_merge($role->getPermissionNames(), $result);
        }
        return $result;
    }

    /**
     * @param string $permissionName
     * @return bool
     */
    public function hasPermission(string $permissionName) : bool {
        $currentUser = auth()->user();
        $currentUserPermissionNames = $currentUser->getPermissionNames();
        return in_array($permissionName, $currentUserPermissionNames) ? true : false;
    }

    /**
     * @param string $permissionName
     * @throws AuthorizationException
     */
    public function requirePermission(string $permissionName) {
        if(!$this->hasPermission($permissionName)) {
            throw new AuthorizationException("User '{$this->name}' does not have '{$permissionName}' permission.");
        }
    }
}
