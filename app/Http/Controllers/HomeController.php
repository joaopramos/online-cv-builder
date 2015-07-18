<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CV;
use PDF;
use Auth;

class HomeController extends Controller
{
    public function index() { return view('index'); }
    public function home() { return redirect('/'); }
    public function getCv($slug) {
        $cv = CV::where('slug', '=', $slug)->first();
        if($cv && $cv->published)
            return view('cv')->with('cv', $cv);
        else
            return redirect('/');
    }
    public function pdf() {
        $cv = Auth::user()->cv;
        $pdf = PDF::loadView('cv', ['cv'=>$cv]);
        return $pdf->download('cv.pdf');
    }
}
