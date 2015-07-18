<?php

namespace App\Http\Controllers\Cv;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Cv\CvController;
use App\SectionGroup;

class SectionGroupController extends CvController
{
    protected function model() {
        return new SectionGroup;
    }
}
