<?php

namespace App\Http\Controllers\Cv;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Cv\CvController;
use App\Section;

class SectionController extends CvController
{
    protected function model() {
        return new Section;
    }
}
