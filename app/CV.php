<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CV extends Model
{
    public $timestamps = false;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cvs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'template_id', 'slug', 'published', 'profilepic'];

    public function template()
    {
        return $this->belongsTo('App\Template', 'template_id');
    }

    public function section()
    {
        return $this->hasMany('App\Section', 'cv_id');
    }
    public function cvHeader()
    {
        return $this->hasMany('App\CvHeader', 'cv_id');
    }
    public function childs() {
        return array(
            'cvHeader' => $this->cvHeader,
            'section' => $this->section,
        );
    }
}
