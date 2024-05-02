<?php

namespace App\Http\Controllers\Api;

//import model Post


use App\Http\Controllers\Controller;

//import resource PostResource
use App\Http\Resources\RTextResource;
use App\Models\RText;

class RTextController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all posts
        $RTexts = RText::latest()->paginate(5);

        //return collection of posts as a resource
        return new RTextResource(true, 'List Data Posts', $RTexts);
    }
}
