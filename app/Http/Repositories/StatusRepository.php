<?php

namespace App\Http\Repositories;

use App\Perpus;
use App\Status;

class StatusRepository{
    public function updateStatus($request = [], $id){
       
        $result = ["status" => false, "message" => ""];
        try {
            $id->update([
                'status' => $request->status
            ]);
            $result['status'] = true;
            $result['message'] = 'berhasil diupdate';
            return $result;
        } catch (\Throwable $th) {
            $result["message"] =  'Funtion Error'.$th->getMessage();
            return $result;
        }
    }

    public function approveStatus(){
        return Status::where('status', 'Approve')->with(['perpus', 'user'])->get();
    }

    public function returnStatus(){
        return Status::where('status', 'dikembalikan')->with(['perpus', 'user'])->get();
    }

    public function historyStatus(){
        return Status::where('status', 'dikembalikan')->with(['perpus', 'user'])->get();
    }
}