<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CV;
use PDF;
use Auth;
use URL;
use App\Template;

class HomeController extends Controller
{
    public function index() {
        $cv = Auth::check() ? Auth::user()->cv : null;
        return view('index')->with('cv', $cv);
    }
    public function home() { return redirect('/'); }

    public function getCv($slug) {
        $cv = CV::where('slug', '=', $slug)->first();
        if($cv && $cv->published)
            return view('cv')->with('cv', $cv);
        else
            return redirect('/');
    }

    public function templates() {
        $templates = Template::all(['id','name','thumbnail']);
        return response()->json($templates->toArray(),200);
    }

    public function setTemplate($id) {
        $cv = Auth::user()->cv;
        $cv->template_id=$id;
        $cv->save();
        return redirect('/');
    }

    public function renderPDF($slug) {
        $cv = CV::where('slug', '=', $slug)->first();
        if($cv && $cv->published)
            return view('pdf')->with('cv', $cv);
        else
            return redirect('/');
    }

    public function pdf() {
        $cv = Auth::user()->cv;
        if(!$cv->published)
            return redirect('/profile')->withErrors(['message'=>
                'You need to publish your CV in order to print the pdf file.']);
        $pdf = PDF::loadFile(URL::to('/').'/'.$cv->slug.'/renderpdf');
        return $pdf->download('cv.pdf');
    }
}
