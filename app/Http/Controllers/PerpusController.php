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

    public function create(){
        return view('Perpus.create');
    }

    public function store(NewBookRequest $request){
            $bukuRepo = $this->BookRepo->storebuku($request);
        Session::flash('message', $bukuRepo['message']);
        if(!$bukuRepo['status']){
            Session::flash('alert-class', 'alert-danger');
        }else{
            Session::flash('alert-class', 'alert-success');
        }
        return redirect()->route('home');
    }

    public function destroy($id) {
        $this->BookRepo->hapusBuku($id);
        return redirect()->route('home');
    
    }

    public function edit(Perpus $id){
        return view('Perpus.edit', compact('id'));
    }

    public function update(NewBookRequest $request, Perpus $id){
        $this->BookRepo->updateBuku($request, $id);
        return redirect()->route('home');
    }
}
