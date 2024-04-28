<?php

namespace App\Http\Controllers\Api;

//import model header
use App\Models\Header;

use App\Http\Controllers\Controller;

//import resource HeaderResource
use App\Http\Resources\HeaderResource;

//import Http request
use Illuminate\Http\Request;

//import facade Validator
use Illuminate\Support\Facades\Validator;

//import facade Storage
use Illuminate\Support\Facades\Storage;

class HeaderController extends Controller
{
    /**
     * index
     *
     * @return HeaderResource
     */
    public function index()
    {
        //get all logo from header
        $header = Header::latest()->paginate(1);

        //return collection of header as a resource
        return new HeaderResource(true, 'List Logo Header', $header);
    }

    /**
     * store
     *
     * @param  Request $request
     * @return HeaderResource
     */
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'logo1'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'logo2'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload logo1
        $logo1 = $request->file('logo1');
        $logo1->storeAs('public/header/upload/', $logo1->hashName());

        //upload logo2
        $logo2 = $request->file('logo2');
        $logo2->storeAs('public/header/upload/', $logo2->hashName());

        //create header
        $header = Header::create([
            'logo1'     => $logo1->hashName(),
            'logo2'     => $logo2->hashName(),
        ]);

        //return response
        return new HeaderResource(true, 'Logo Header Berhasil Ditambahkan!', $header);
    }

    /**
     * show
     *
     * @param  int  $id
     * @return HeaderResource
     */
    public function show($id)
    {
        //find header by ID
        $header = Header::find($id);

        //return both logo in one header as a resource
        return new HeaderResource(true, 'Detail Logo Header.', $header);
    }

    /**
     * update
     *
     * @param  Request  $request
     * @param  int  $id
     * @return HeaderResource
     */
    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'logo1'     => 'required',
            'logo2'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find header by ID
        $header = Header::find($id);

        //check if logo is not empty
        if ($request->hasFile('logo1')) {

            //upload image
            $logo1 = $request->file('logo1');
            $logo1->storeAs('public/beritas/upload/', $logo1->hashName());

            //delete old image
            Storage::delete('public/beritas/upload/' . basename($header->logo1));

            //update header with new logo1
            $header->update([
                'logo1'     => $logo1->hashName(),
                'logo2'     => $header->logo2,
            ]);
        } else if ($request->hasFile('logo2')) {

            //upload image
            $logo2 = $request->file('logo2');
            $logo2->storeAs('public/beritas/upload/', $logo2->hashName());

            //delete old image
            Storage::delete('public/beritas/upload/' . basename($header->logo2));

            //update header with new logo2
            $header->update([
                'logo1'     => $header->logo1,
                'logo2'     => $logo2->hashName(),
            ]);
        }

        //return response
        return new HeaderResource(true, 'Logo Header Berhasil Diubah!', $header);
    }

    /**
     * destroy
     *
     * @param  int  $id
     * @return HeaderResource
     */
    public function destroy($id)
    {

        //find header by ID
        $header = Header::find($id);

        //delete logo 1
        Storage::delete('public/beritas/upload/'.basename($header->logo1));

        //delete logo 2
        Storage::delete('public/beritas/upload/'.basename($header->logo2));

        //delete header
        $header->delete();

        //return response
        return new HeaderResource(true, 'Logo Header Berhasil Dihapus!', null);
    }
}
