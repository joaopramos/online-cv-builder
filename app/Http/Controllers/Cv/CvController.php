<?php

namespace App\Http\Controllers\Cv;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CV;
use Response;
use Route;
use Image;

class CvController extends Controller
{
    protected $resource;

    protected function model(){
        return new CV;
    }

    public function __construct(Request $request)
    {
        $this->resource=$this->model();

        if(!Route::current()) return; // enable artisan route:list
        $userId = $this->getUserIdFromParams($request->getMethod(), $request->all());
        $this->middleware("canRead:$userId", ['only' => ['index', 'show']]);
        $this->middleware("canWrite:$userId", ['only' => ['store', 'update', 'destroy']]);
    }


    public function show($id) {
        $resource=$this->resource->toArray();
        return Response::json( array(
            'data' => $resource,
            'childs' => $this->resource->childs(),
        ), 200);
    }

    public function store(Request $request) {
        $input = $request->all();
        $this->resource->fill($input)->save();
        return Response::json( array(
            'data' => $this->resource->toArray(),
        ), 200);
    }

    public function update($id, Request $request) {
        $input = $request->all();
        $this->resource->findOrFail($id);
        $this->resource->fill($input);
        if(isset($input['profilepic']))
            $this->resource->profilepic = $this->processImage($input[ 'profilepic' ], 500);

        $this->resource->save();
        return Response::json( array(
            'data' => $this->resource->toArray(),
        ), 200);
    }


    public function destroy($id) {
        $this->resource->find($id);
        $this->resource->delete();
        return Response::json(array("message"=>'record deleted'), 200);
    }

    protected function getUserIdFromParams($method, $input)
    {
        $parameters = Route::current()->parameters();
        $id=reset($parameters);

        if($method=='POST' && !$id) { // store resource -> get parent owner
            $this->resource->fill($input);
            $parent=$this->resource->parent;
            return isset($parent->user_id) ? $parent->user_id : $parent->created_by;
        }
        else if($id) {
            $this->resource = $this->resource->find($id);
            return isset($this->resource->user_id) ? $this->resource->user_id : $this->resource->created_by;
        }
        else abort(403, 'Unauthorized');
    }

    protected function processImage($thumbnail, $maxWidth) {
        $img = Image::make($thumbnail)
        ->resize($maxWidth, null, function ($constraint) {
            $constraint->aspectRatio();
        })->encode('jpg', 80);
        $thumbnail = 'data:image/' . 'jpg' . ';base64,' . base64_encode($img);

        return $thumbnail;
    }

}
