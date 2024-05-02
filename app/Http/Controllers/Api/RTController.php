<?php

namespace App\Http\Controllers\Api;

//import model Post
use App\Models\RT;

use App\Http\Controllers\Controller;

//import resource PostResource
use App\Http\Resources\RTResource;

//import Http request
use Illuminate\Http\Request;

//import facade Validator
use Illuminate\Support\Facades\Validator;

class RTController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all posts
        $RTs = RT::latest()->paginate(5);

        //return collection of posts as a resource
        return new RTResource(true, 'List Data Posts', $RTs);
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
            'RT'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        //create post
        $RT = RT::create([
            'RT'   => $request->RT,
        ]);

        //return response
        return new RTResource(true, 'Data Post Berhasil Ditambahkan!', $RT);
    }

    public function show($id)
    {
        $RTs = RT::latest()->paginate(5);

        // Mengirimkan data ke view
        return view('display.index', compact('RTs'));
    }

     /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function update(Request $request, $id)
{
    // Define validation rules
    $validator = Validator::make($request->all(), [
        'RT' => 'required',
    ]);

    // Check if validation fails
    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    // Find RT by ID
    $RT = RT::find($id);

    // Check if RT exists
    if (!$RT) {
        return response()->json(['message' => 'RT not found'], 404);
    }

    // Update RT with new data
    $RT->update([
        'RT' => $request->input('RT'),
    ]);

    // Return response
    return response()->json([
        'success' => true,
        'message' => 'Data RT Berhasil Diubah!',
        'data' => $RT,
    ]);
}

public function destroy($id)
{

    //find post by ID
    $RT = RT::find($id);

    //delete RT
    $RT->delete();

    //return response
    return new RTResource(true, 'Data RT Berhasil Dihapus!', null);
}
}
