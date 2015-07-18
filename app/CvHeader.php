<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class CvHeader extends Model
{
    public $timestamps = false;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cv_headers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['cv_id', 'name', 'value'];

    public function childs() {
        return null;
    }

    public function parent()
    {
        return $this->belongsTo('App\CV', 'cv_id');
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function($record)
        {
            $record->created_by = Auth::user()->id;
        });
    }

}
