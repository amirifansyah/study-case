<?php

namespace App\Http\Controllers;

use App\Http\Repositories\BukuRepository;
use App\Http\Requests\PinjamRequest;
use Illuminate\Http\Request;
use App\Perpus;
use App\Status;
use Illuminate\Support\Facades\Auth;

class PinjamController extends Controller
{
    protected $PinjamRepo;
    public function __construct()
    {
        $this->PinjamRepo = new BukuRepository;
    }

    public function history(PinjamRequest $request){
        $this->PinjamRepo->pinjam($request->all());
        return redirect()->route('user.pinjambuku')->with('pesan', 'berhasil disimpan');
    }

    public function pinjambuku(){
        if(Auth::user()->role == 'admin'){
            $status = $this->PinjamRepo->statusPinjam();
            return view('User.create', compact('status'));
        }else{
            $status = $this->PinjamRepo->buttonDelete();
        return view('User.create', compact('status'));
    }
    }
}
