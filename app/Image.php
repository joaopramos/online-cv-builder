<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Image extends Model
{
    public $timestamps = false;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['entry_id', 'thumbnail', 'description', 'image', 'ordered'];

    public function childs() {
        return null;
    }

    public function parent()
    {
        return $this->belongsTo('App\Entry', 'entry_id');
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
