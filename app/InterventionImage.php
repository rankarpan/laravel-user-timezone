<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InterventionImage extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'intervention_image';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'images'];

}
