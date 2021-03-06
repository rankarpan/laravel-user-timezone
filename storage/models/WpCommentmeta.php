<?php namespace App;

/**
 * Eloquent class to describe the wp_commentmeta table
 *
 * automatically generated by ModelGenerator.php
 */
class WpCommentmeta extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'wp_commentmeta';

    public $primaryKey = 'meta_id';

    public $timestamps = false;

    protected $fillable = array('comment_id', 'meta_key', 'meta_value');

}

