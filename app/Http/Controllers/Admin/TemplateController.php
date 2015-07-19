<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Template;
use Image;

class TemplateController extends Controller
{
    public function index()
    {
       return view('admin.template.index')->with('templates', Template::all());
    }

    public function create()
    {
        return view('admin.template.create');
    }

    public function store( Request $request )
    {
       $input = $request->all();
       $template = new Template;
       $template->fill($input)->save();
       return redirect('admin/template');
    }

    public function show($id)
    {
        return view('admin.template.show')->with('template', Template::findOrFail($id));
    }

    public function edit($id)
    {
    }

    public function update($id, Request $request)
    {
       $input = $request->all();
       $template = Template::findOrFail($id);

        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $filename = date('Y-m-d-H:i:s')."-".$image->getClientOriginalName();
            $path = public_path('dist/images/'.$filename);
            Image::make($image->getRealPath())->resize(500, null,
                function ($constraint) {
                    $constraint->aspectRatio();
            })->save($path);
            $template->thumbnail = 'dist/images/'.$filename;
        }

       $template->fill($input)->save();
       return redirect('admin/template');

       $input = $request->all();
       $template = Template::findOrFail($id);
       if($request->hasFile('image'))
            $template->thumbnail = $this->getImageBase64( $request->file('image') );
       $template->fill($input)->save();
       return redirect('admin/template');
    }

    public function destroy($id)
    {
       Template::findOrFail($id)->delete();
       return redirect('admin/template');
    }

    protected function getImageBase64($file) {
        if( !$file->isValid())
            return  Redirect::back()->withErrors(['image' => 'Error uploading']);;
        $type='jpg';
        $img = Image::make($file->getRealPath())
        ->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
        })->encode($type, 75);
        $thumbnail = 'data:image/' . $type . ';base64,' . base64_encode($img);

        return $thumbnail;
    }
}
