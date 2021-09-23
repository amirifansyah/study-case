<?php

namespace App\Http\Controllers;

use App\Http\Repositories\PustakaRepository;
use App\Http\Requests\PustakaRequest;
use App\Pustaka;
use Illuminate\Http\Request;

class PustakaController extends Controller
{
    protected $pustakaRepo;

    public function __construct()
    {
        $this->pustakaRepo = new PustakaRepository;
    }
    public function daftarBuku(){
        return view('Pustaka.home');
    }

    public function newBook(Pustaka $id){
        return view('Pustaka.create', compact('id'));
    }

    public function pustakaStore(PustakaRequest $request, $id = null){

    }
}
