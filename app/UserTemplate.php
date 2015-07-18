<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTemplate extends Model
{
    public $timestamps = false;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_templates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['item_id', 'name', 'value', 'ordered'];

}
