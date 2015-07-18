<?php

namespace App\Http\Controllers\Cv;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Cv\CvController;
use App\Image;
use Response;

class ImageController extends CvController
{
    protected function model() {
        return new Image;
    }

    public function store(Request $request) {
        $input = $request->all();
        $this->resource->fill($input)->save();
        if(isset($input['image']))
            $this->resource->image = $this->processImage($input[ 'image' ], 500);
        return Response::json( array(
            'data' => $this->resource->toArray(),
        ), 200);
    }

    public function update($id, Request $request) {
        $input = $request->all();
        $this->resource->findOrFail($id);
        $this->resource->fill($input);
        if(isset($input['image']))
            $this->resource->image = $this->processImage($input[ 'image' ], 500);

        $this->resource->save();
        return Response::json( array(
            'data' => $this->resource->toArray(),
        ), 200);
    }
}
