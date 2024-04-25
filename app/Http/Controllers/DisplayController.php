<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//import model berita
use App\Models\Berita;

//import model agenda
use App\Models\Agenda;

//import model header
use App\Models\Header;

//import model rtext
use App\Models\RText; 

//import return type View
use Illuminate\View\View;

class DisplayController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index() : View
    {
        //get all berita
        $berita = Berita::latest()->paginate(5);

        //get all agenda
        $agenda = Agenda::latest()->paginate(5);

        //get all header
        $header = Header::latest()->paginate(5);

        //get all rtext
        $rtext = RText::latest()->paginate(5);

        //render view with all table
        return view('display.index', compact('berita', 'agenda', 'header', 'rtext'));
    }
}