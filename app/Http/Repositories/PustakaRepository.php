<?php

namespace App\Http\Repositories;

use App\Pustaka;

class PustakaRepository{
    public function storeBuku($request, $id = null){
        $result = ["status" => false, "message" => ""];
        $data   = $request->all();
        
        try {
            if($id){
                // dd($request->all());
                if($request->hasfile('gambar')){
                    // if(\File::exists('storage/gambar-buku/'.$id->gambar)){
                    //     \File::delete('storage/gambar-buku/'.$id->gambar);
                    // }
                    
                    $image      = $request->file('gambar');
                    $file    = time() . '.' . $image->getClientOriginalExtension();
                    $request->file('gambar')->storeAs('public/gambar-buku/', $file);
                    Pustaka::findOrFail($id)->update([
                        'judul_buku'    => $request->judul_buku,
                        'gambar'        => $file,
                        'desc'          => $request->desc,
                        'stok'          => $request->stok,
                        'kategori'      => $request->kategori,
                        'pengarang'     => $request->pengarang
                    ]);
                }else{
                    Pustaka::findOrFail($id)->update($data);
                }

                $result["status"]   = true;
                $result["message"]  = "Berhasil Disimpan";
                return $result;
            }else{
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