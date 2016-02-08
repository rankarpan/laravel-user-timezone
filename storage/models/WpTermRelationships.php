<?php namespace App;

/**
 * Eloquent class to describe the wp_term_relationships table
 *
 * automatically generated by ModelGenerator.php
 */
class WpTermRelationships extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'wp_term_relationships';

    public $primaryKey = 'term_taxonomy_id';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = array('term_order');

}
