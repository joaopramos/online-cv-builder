<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Entry extends Model
{
    public $timestamps = false;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'entries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['item_id', 'entry', 'ordered'];

    public function image()
    {
        return $this->hasMany('App\Image', 'entry_id');
    }

    public function childs() {
        return array(
            'image' => $this->image,
        );
    }

    public function parent()
    {
        return $this->belongsTo('App\Item', 'item_id');
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
