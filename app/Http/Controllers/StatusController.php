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

    public function approveBuku(){
        $status = $this->statusRepo->approveStatus();
        return view('status.approve', compact('status'));
    }

    public function returnBuku(){
        $status = $this->statusRepo->returnStatus();
        return view('status.dikembalikan', compact('status'));
    }

    public function historyBuku(){
        $status = $this->statusRepo->historyStatus();
        return view('status.dikembalikan', compact('status'));
    }

    public function updateStatus(PinjamRequest $request,Status $id){
        if($request['status'] == 'Approve'){
            $this->editstok->statusStokKurang($request, $id);
            return redirect()->route('user.pinjambuku');
        }else if($request['status'] == 'dikembalikan'){
            $this->editstok->statusStokTambah($request,$id);
            return redirect()->route('status.dikemabalikan');
        }else{
            $this->statusRepo->updateStatus($request, $id);
            return redirect()->route('user.pinjambuku');
        }
    }
}

