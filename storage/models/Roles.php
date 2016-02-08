<?php namespace App;

/**
 * Eloquent class to describe the roles table
 *
 * automatically generated by ModelGenerator.php
 */
class Roles extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'roles';

    protected $fillable = array('name');

    public function permissionss()
    {
        return $this->belongsToMany('App\Permissions', 'role_has_permissions', 'permission_id', 'role_id');
    }

    public function userss()
    {
        return $this->belongsToMany('App\Users', 'user_has_roles', 'user_id', 'role_id');
    }

}
