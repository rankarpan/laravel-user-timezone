<?php namespace App;

/**
 * Eloquent class to describe the wp_posts table
 *
 * automatically generated by ModelGenerator.php
 */
class WpPosts extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'wp_posts';

    public $primaryKey = 'ID';

    public $timestamps = false;

    public function getDates()
    {
        return array('post_date', 'post_date_gmt', 'post_modified', 'post_modified_gmt');
    }

    protected $fillable = array('post_author', 'post_date', 'post_date_gmt', 'post_content', 'post_title',
        'post_excerpt', 'post_status', 'comment_status', 'ping_status', 'post_password', 'post_name', 'to_ping', 'pinged',
        'post_modified', 'post_modified_gmt', 'post_content_filtered', 'post_parent', 'guid', 'menu_order', 'post_type',
        'post_mime_type', 'comment_count');

}
