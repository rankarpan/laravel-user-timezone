<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class ExpiryUrl extends Model implements SluggableInterface
{
    protected $table = 'expiry_url';

    protected $fillable = ['title', 'url', 'duration'];

    use SluggableTrait;

    protected $sluggable = [
        'build_from' => 'title',
        'save_to'    => 'url',
    ];
    
}
