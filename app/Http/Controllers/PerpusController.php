<?php

namespace App\Http\Controllers;

use App\Http\Repositories\BukuRepository;
use App\Http\Requests\NewBookRequest;
use App\Perpus;
use Session;
use Illuminate\Http\Request;

class PerpusController extends Controller
{
    protected $BookRepo;

    public function __construct()
    {
        $this->BookRepo = new BukuRepository;
    }

    public function create(Perpus $id){
        return view('perpus.create', compact('id'));
    }

    public function store(NewBookRequest $request, $id = null){
        $bukuRepo = $this->BookRepo->storeBuku($request, $id);
        Session::flash('message', $bukuRepo['message']);

        // cara singkat
        $sessionStatus = $bukuRepo['status'] ? 'alert-success' : 'alert-danger';
        session::flash('alert-class', $sessionStatus);

        //cara panjang
        // if(!$bukuRepo['status']){
        //     Session::flash('alert-class', 'alert-danger');
        // }else{
        //     Session::flash('alert-class', 'alert-success');
        // }
        return redirect()->route('home');
    }

    public function destroy($id) {
        $this->BookRepo->hapusBuku($id);
        return redirect()->route('home');
    }

    public function edit(Perpus $id){
        return view('perpus.edit', compact('id'));
    }

    public function update(NewBookRequest $request, Perpus $id){
        $this->BookRepo->updateBuku($request, $id);
        return redirect()->route('home');
    }
}
