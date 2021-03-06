<?php namespace App;

/**
 * Eloquent class to describe the expiry_url table
 *
 * automatically generated by ModelGenerator.php
 */
class ExpiryUrl extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'expiry_url';

    public function getDates()
    {
        return array('deleted_at');
    }

    protected $fillable = array('title', 'url', 'expires', 'signature', 'duration', 'deleted_at');

}

