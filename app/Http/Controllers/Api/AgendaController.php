<?php

namespace App\Http\Controllers\Api;

//import model Agenda
use App\Models\Agenda;

use Illuminate\Http\Request;

//import resource PostResource
use App\Http\Controllers\Controller;

//import Http request
use App\Http\Resources\AgendaResource;

//import facade Validator
use Illuminate\Support\Facades\Validator;

//import facade Storage
use Illuminate\Support\Facades\Storage;

class AgendaController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all posts
        $agenda = Agenda::all();

        //return collection of posts as a resource
        return new AgendaResource(true, 'List Agenda', $agenda);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama_kegiatan'     => 'required',
            'tempat'     => 'required',
            'tanggal'   => '',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create Agenda
        $agenda = Agenda::create([
            'nama_kegiatan'     => $request->nama_kegiatan,
            'tempat'     => $request->tempat,
            'tanggal'   => $request->tanggal,
        ]);

        //return response
        return new AgendaResource(true, 'Data Agenda Berhasil Ditambahkan!', $agenda);

    }
    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */

    // UNTUK MENAMPILKAN DATA AGENDA
     public function show($id)
    {
        //find post by ID
        $agenda = Agenda::find($id);

        //return single post as a resource
        return new AgendaResource(true, 'Detail Data Agenda :', $agenda);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */



     // UNTUK UPDATE DATA AGENDA
    public function update(Request $request, $id)
{
    //define validation rules
    $validator = Validator::make($request->all(), [
        'nama_kegiatan'     => 'required',
        'tempat'     => 'required',
        'tanggal'   => '',
    ]);

    //check if validation fails
    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    //find agenda by ID
    $agenda = Agenda::find($id);

    //check if agenda exists
    if (!$agenda) {
        return response()->json(['message' => 'Agenda not found'], 404);
    }

    //update agenda data
    $agenda->update([
        'nama_kegiatan' => $request->nama_kegiatan,
        'tempat' => $request->tempat,
        'tanggal' => $request->tanggal,
    ]);

    //return response
    return new AgendaResource(true, 'Data Agenda Berhasil Diubah!', $agenda);
}

 /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */

    // UNTUK MENGHAPUS DATA AGENDA
    public function destroy($id)
    {

        //find post by ID
        $agenda = Agenda::find($id);

        //delete post
        $agenda->delete();

        //return response
        return new AgendaResource(true, 'Data Agenda Berhasil Dihapus!', null);
    }

    }

