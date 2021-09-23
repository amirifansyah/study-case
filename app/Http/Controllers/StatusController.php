<?php

namespace App\Http\Controllers;

use App\Http\Repositories\BukuRepository;
use App\Http\Repositories\StatusRepository;
use App\Http\Requests\PinjamRequest;
use App\Perpus;
use App\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    protected $statusRepo, $editstok;

    public function __construct()
    {
        $this->statusRepo = new StatusRepository;
        $this->editstok = new BukuRepository;
    }
    
    // public function status(){
    //     $this->statusRepo = new StatusRepository;
    // }

    public function approve(){
        $status = $this->statusRepo->approvestatus();
        return view('status.approve', compact('status'));
    }

    public function return(){
        $status = $this->statusRepo->returnstatus();
        return view('status.dikembalikan', compact('status'));
    }

    public function historybuku(){
        $status = $this->statusRepo->historystatus();
        return view('status.dikembalikan', compact('status'));
    }

    public function updatestatus(PinjamRequest $request,Status $id){
        if($request['status'] == 'Approve'){
            $this->editstok->stokKurang($request, $id);
            return redirect()->route('user.pinjambuku');
        }else if($request['status'] == 'dikembalikan'){
            $this->editstok->stokTambah($request,$id);
            return redirect()->route('status.dikemabalikan');
        }else{
            $this->statusRepo->updatestatus($request, $id);
            return redirect()->route('user.pinjambuku');
        }
    }
}

