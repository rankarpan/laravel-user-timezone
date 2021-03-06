<?php namespace App;

/**
 * Eloquent class to describe the wp_links table
 *
 * automatically generated by ModelGenerator.php
 */
class WpLinks extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'wp_links';

    public $primaryKey = 'link_id';

    public $timestamps = false;

    public function getDates()
    {
        return array('link_updated');
    }

    protected $fillable = array('link_url', 'link_name', 'link_image', 'link_target', 'link_description',
        'link_visible', 'link_owner', 'link_rating', 'link_updated', 'link_rel', 'link_notes', 'link_rss');

}

