<?php

namespace App\Http\Repositories;

use App\Pustaka;

class PustakaRepository{
    public function findById($id){
        return Pustaka::with([])
            ->find($id);
    }

    public function storeBuku($request, $id = null){
        $result = ["status" => false, "message" => ""];

        // try {
        //     $findPustaka = $this->findById($id);
        //     if($request->hasfile('gambar')){
        //         $image      = $request->file('gambar');
        //         $file    = time() . '.' . $image->getClientOriginalExtension();
        //         $request->file('gambar')->storeAs('public/gambar-buku/', $file);
        //     }else{
        //         $file = $request->gambar;
        //     }
        //     if (!$findPustaka) {
        //         $findPustaka = new Pustaka;
        //     }

        //     $findPustaka->judul_buku = $request->judul_buku;
        //     $findPustaka->gambar      = $file;
        //     $findPustaka->desc       = $request->desc;
        //     $findPustaka->stok       = $request->stok;
        //     $findPustaka->kategori   = $request->kategori;
        //     $findPustaka->pengarang  = $request->pengarang;
        //     $findPustaka->save();

        //     $result['status']   = true;
        //     $result['message']  = "Berhasil Disimpan";
        //     return $result;
        // } catch (\Throwable $th) {
        //     $result['message'] = 'Error :'. $th->getMessage();
        //     return $result;
        // }

        try {
            if($id){
                $bukuRepo = Pustaka::findOrFail($id);
                if($request->gambar){
                    if(\File::exists('storage/gambar-buku/'. $bukuRepo->gambar )){
                        \File::delete('storage/gambar-buku/'. $bukuRepo->gambar);
                    }
                    $file = $bukuRepo->gambar;
                    $request->file('gambar')->storeAs( 'public/gambar-buku/',  $file);
                }else{
                    $file = $bukuRepo->gambar;
                }
            }else{
                $bukuRepo = new Pustaka;

                if(!$request->gambar){
                    $result["status"]  = false;
                    $result["message"] = "Failed";
                    return $result;
                }

                $image     = $request->file('gambar');
                $file  = time() . '.' . $image->getClientOriginalExtension();
                $request->file('gambar')->storeAs( 'public/gambar-buku/',  $file);
            }

            $bukuRepo->kategori   = $request->kategori;
            $bukuRepo->judul_buku = $request->judul_buku;
            $bukuRepo->desc       = $request->desc;
            $bukuRepo->stok       = $request->stok;
            $bukuRepo->pengarang  = $request->pengarang;
            $bukuRepo->gambar      = $file;
            $bukuRepo->save();

            $result["status"]  = true;
            $result["message"] = "Success";
            return $result;

    } catch (\Throwable $th) {
        $result["message"] = $th->getMessage();
        return $result;
    }

        #nyoba
        // $data   = $request->all();
        
        // try {
        //     if($id){
        //         $buku = Pustaka::findOrFail($id);
        //         if($request->gambar){
        //             $file = $buku->gambar;
        //             if(\File::exists('storage/gambar-buku/'.$buku->gambar)){
        //                 \File::delete('storage/gambar-buku/'.$buku->gambar);
        //             }
        //             $request->file('gambar')->storeAs('public/gambar-buku/', $file);
        //             $buku->update([
        //                 'judul_buku'    => $request->judul_buku,
        //                 'gambar'        => $file,
        //                 'desc'          => $request->desc,
        //                 'stok'          => $request->stok,
        //                 'kategori'      => $request->kategori,
        //                 'pengarang'     => $request->pengarang
        //             ]);
        //             $result["status"]   = true;
        //             $result["message"]  = "Berhasil Disimpan";
        //             return $result;
        //         }else{
        //             $buku->update($data);
        //             $result["status"]   = true;
        //             $result["message"]  = "Berhasil Disimpan";
        //             return $result;
        //         }
        //     }else{
        //         if(!$request->hasFIle('gambar')){
        //             $result['status'] = false;
        //             $result ['message'] = "Gambar Tidak Boleh Kosong";
        //             return $result;
        //         }
        //         if($request->hasfile('gambar')){
        //             $image      = $request->file('gambar');
        //             $file    = time() . '.' . $image->getClientOriginalExtension();
        //             $request->file('gambar')->storeAs('public/gambar-buku/', $file);
        //         }

        //         Pustaka::create([
        //             'judul_buku'    => $request->judul_buku,
        //             'gambar'        => $file,
        //             'desc'          => $request->desc,
        //             'stok'          => $request->stok,
        //             'kategori'      => $request->kategori,
        //             'pengarang'     => $request->pengarang
        //         ]);
        //         $result["status"]   = true;
        //         $result['message']  = "Buku Sudah Ditambahkan";
        //         return $result;
        //     };
        // } catch (\Throwable $th) {
        //     $result["message"] =  'Funtion Store Error'.$th->getMessage();
        //     return $result;
        // }
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