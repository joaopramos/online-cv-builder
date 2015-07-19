<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    public $timestamps = false;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'templates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'template', 'css', 'pdf_template'];

}
