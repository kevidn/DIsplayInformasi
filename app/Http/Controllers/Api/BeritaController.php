<?php

namespace App\Http\Controllers\Api;

//import model Berita
use App\Models\Berita;

use App\Http\Controllers\Controller;

//import resource BeritaResource
use App\Http\Resources\BeritaResource;

//import Http request
use Illuminate\Http\Request;

//import facade Validator
use Illuminate\Support\Facades\Validator;

//import facade Storage
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all beritas
        $berita = Berita::all();

        //return collection of beritas as a resource
        return view('display.index', compact('berita'));
    }

    /**
     * index api
     *
     * @return void
     */
    public function index_api()
    {
        //get all beritas
        $berita = Berita::latest()->paginate(1);

        //return collection of beritas as a resource
        return new BeritaResource(true, 'List Data Berita', $berita);
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
            'judul'     => 'required',
            'gambar'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'isi'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        $gambar = $request->file('gambar');
        $gambar->storeAs('public/beritas/upload/', $gambar->hashName());

        //create berita
        $berita = berita::create([
            'judul'     => $request->judul,
            'gambar'     => $gambar->hashName(),
            'isi'   => $request->isi,
        ]);

        //return response
        return new BeritaResource(true, 'Data Berita Berhasil Ditambahkan!', $berita);
    }

        /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        //find berita by ID
        $berita = Berita::find($id);

        //return single berita as a resource
        return new BeritaResource(true, 'Detail Data Berita.', $berita);
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
        //define validation rules
        $validator = Validator::make($request->all(), [
            'judul'     => 'required',
            'isi'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find post by ID
        $berita = Berita::find($id);

        //check if image is not empty
        if ($request->hasFile('gambar')) {

            //upload image
            $gambar = $request->file('gambar');
            $gambar->storeAs('public/beritas/upload/', $gambar->hashName());

            //delete old image
            Storage::delete('public/beritas/upload/' . basename($berita->gambar));

            //update berita with new image
            $berita->update([
                'judul'     => $request->judul,
                'gambar'     => $gambar->hashName(),
                'isi'   => $request->isi,
            ]);
        } else {

            //update berita without image
            $post->update([
                'title'     => $request->title,
                'content'   => $request->content,
            ]);
        }

        //return response
        return new BeritaResource(true, 'Data Berita Berhasil Diubah!', $berita);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {

        //find berita by ID
        $berita = Berita::find($id);

        //delete image
        Storage::delete('public/beritas/upload/'.basename($berita->gambar));

        //delete berita
        $berita->delete();

        //return response
        return new BeritaResource(true, 'Data Berita Berhasil Dihapus!', null);
    }
}