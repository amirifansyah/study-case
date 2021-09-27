<?php

namespace App\Http\Repositories;

use App\Pustaka;

class PustakaRepository{
    public function storeBuku($request, $id = null){
        $result = ["status" => false, "message" => ""];
        $data   = $request->all();
        
        try {
            if($id){
                $buku = Pustaka::findOrFail($id);
                if($request->gambar){
                    $file = $buku->gambar;
                    if(\File::exists('storage/gambar-buku/'.$buku->gambar)){
                        \File::delete('storage/gambar-buku/'.$buku->gambar);
                    }
                    $request->file('gambar')->storeAs('public/gambar-buku/', $file);
                    $buku->update([
                        'judul_buku'    => $request->judul_buku,
                        'gambar'        => $file,
                        'desc'          => $request->desc,
                        'stok'          => $request->stok,
                        'kategori'      => $request->kategori,
                        'pengarang'     => $request->pengarang
                    ]);
                    $result["status"]   = true;
                    $result["message"]  = "Berhasil Disimpan";
                    return $result;
                }else{
                    $buku->update($data);
                    $result["status"]   = true;
                    $result["message"]  = "Berhasil Disimpan";
                    return $result;
                }
            }else{
                if(!$request->hasFIle('gambar')){
                    $result['status'] = false;
                    $result ['message'] = "Gambar Tidak Boleh Kosong";
                    return $result;
                }
                if($request->hasfile('gambar')){
                    $image      = $request->file('gambar');
                    $file    = time() . '.' . $image->getClientOriginalExtension();
                    $request->file('gambar')->storeAs('public/gambar-buku/', $file);
                }

                Pustaka::create([
                    'judul_buku'    => $request->judul_buku,
                    'gambar'        => $file,
                    'desc'          => $request->desc,
                    'stok'          => $request->stok,
                    'kategori'      => $request->kategori,
                    'pengarang'     => $request->pengarang
                ]);
                $result["status"]   = true;
                $result['message']  = "Buku Sudah Ditambahkan";
                return $result;
            };
        } catch (\Throwable $th) {
            $result["message"] =  'Funtion Store Error'.$th->getMessage();
            return $result;
        }
    }

    public function getDataBuku(){
        return Pustaka::all();
    }

    public function deleteBuku($id){
        $result = ['status' => false, 'message' => ""];
        try {
            $deleteBuku = Pustaka::find($id);
            $deleteBuku->delete();
            $result['status']   = true;
            $result['message']  = "Buku Berhasil DIhapus";
            return $result;
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
            return $result;
        }
    }
}