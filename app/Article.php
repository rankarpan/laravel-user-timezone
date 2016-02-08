<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Laravel\Uuid\Uuid;

class Article extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'articles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'body', 'created_by'];

    public function getTitleAttribute($value)
    {
        return $value;
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;

        if ($value != NULL || $value != '')
        {
            $this->attributes['body'] = Uuid::generate(3, $value.date('M d, Y'), Uuid::NS_DNS);
        }
    }

    public function user() {
        return $this->belongsTo('App\User', 'created_by');
    }
}
