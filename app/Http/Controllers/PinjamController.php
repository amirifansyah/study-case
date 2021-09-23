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
        $this->PinjamRepo->pinjamBuku($request->all());
        return redirect()->route('user.pinjambuku')->with('pesan', 'berhasil disimpan');
    }

    public function pinjamBuku(){
        $status = Auth::user()->role == 'admin' ? $this->PinjamRepo->statusPinjam() : $this->PinjamRepo->getByDeletedStatus();
        return view('user.create', compact('status'));
    }
}
