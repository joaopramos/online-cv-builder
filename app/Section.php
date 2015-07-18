<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Section extends Model
{
    public $timestamps = false;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sections';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['cv_id', 'name'];

    public function item()
    {
        return $this->hasMany('App\Item', 'section_id');
    }

    public function childs() {
        return array(
            'item' => $this->item,
        );
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
