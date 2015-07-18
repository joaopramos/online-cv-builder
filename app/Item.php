<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Item extends Model
{
    public $timestamps = false;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['section_id', 'name', 'ordered'];

    public function entry()
    {
        return $this->hasMany('App\Entry', 'item_id');
    }
    public function itemHeader()
    {
        return $this->hasMany('App\ItemHeader', 'item_id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Section', 'section_id');
    }

    public function childs() {
        return array(
            'itemHeader' => $this->itemHeader,
            'entry' => $this->entry,
        );
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
