<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class ItemHeader extends Model
{
    public $timestamps = false;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'item_headers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['item_id', 'name', 'value', 'ordered'];

    public function childs() {
        return null;
    }

    public function parent()
    {
        return $this->belongsTo('App\item', 'item_id');
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
