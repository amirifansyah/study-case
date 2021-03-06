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
        $buku = $this->pustakaRepo->getDataBuku();
        return view('pustaka.home', compact('buku'));
    }

    public function newBook(Pustaka $id){
        return view('pustaka.create', compact('id'));
    }

    public function pustakaStore(PustakaRequest $request, $id = null){
        $data = $this->pustakaRepo->storeBuku($request, $id);
        //kodingan sedikit
        $request->session()->flash($data['status'] ? 'true' : 'false', $data['message']);
        return redirect()->route($data['status'] ? 'index.pustaka' : 'create.pustaka');

        //kodingan boros
        // if($data['status'] == false){
        //     $request->session()->flash('false', $data['message']);
        //     return redirect()->route('create.pustaka');
        // }else{
        //     $request->session()->flash('true', $data['message']);
        //     return redirect()->route('index.pustaka');
        // }
    }

    public function destroyBuku($id){
        $this->pustakaRepo->deleteBuku($id);
        return redirect()->route('index.pustaka');
    }
}
