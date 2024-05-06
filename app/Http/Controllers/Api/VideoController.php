<?php

namespace App\Http\Controllers\Api;

//import model Video
use App\Models\VIdeo;

use App\Http\Controllers\Controller;

//import resource VideoResource
use App\Http\Resources\VideoResource;

//import Http request
use Illuminate\Http\Request;

//import facade Validator
use Illuminate\Support\Facades\Validator;

class VIdeoController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all posts
        $video = VIdeo::all();

        //return collection of posts as a resource
        return new VideoResource(true, 'List Video Youtube', $video);
    }
     /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'youtubelinks'     => 'required',

        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }



        //create post
        $video = VIdeo::create([
            'youtubelinks'   => $request->youtubelinks,
        ]);

        //return response
        return new VIdeoResource(true, 'Link Youtube Berhasil Ditambahkan!', $video);
    }
    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        //find post by ID
        $video = Video::find($id);

        //return single post as a resource
        return new VIdeoResource(true, 'Detail Link Video', $video);
    }
}
