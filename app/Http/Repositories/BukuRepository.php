<?php

namespace App\Http\Repositories;

use App\Perpus;
use App\Status;
use Illuminate\Support\Facades\Auth;

class BukuRepository{
        protected $statusRepo;

        public function __construct()
        {
            $this->statusRepo = new StatusRepository;
        }

        public function storeBuku($request, $id = null){
            $result = ["status" => false, "message" => ""];
            try {
                $findPerpus = $this->findById($id);
                if(!$findPerpus){
                    $findPerpus = new Perpus();
                }
                $findPerpus->judul          = $request->judul;
                $findPerpus->deskripsi      = $request->deskripsi;
                $findPerpus->stok           = $request->stok;
                $findPerpus->kategori       = $request->kategori;
                $findPerpus->pengarang      = $request->pengarang;
                $findPerpus->save();
                $result['status']   = true;
                $result['message']  = "Buku Berhasil Disimpan";
                return $result;
            } catch (\Throwable $th) {
                $result['message'] = "function Store Error" . $th->getMessage();
                return $result;
            }



            // $result = ["status" => false, "message" => ""];
            // $data = $request->all();
            // try { 
            //     $BukuRepo = new Perpus();
            //     $BukuRepo->judul        = $data['judul'];
            //     $BukuRepo->deskripsi    = $data['deskripsi'];
            //     $BukuRepo->stok         = $data['stok'];
            //     $BukuRepo->kategori     = $data['kategori'];
            //     $BukuRepo->pengarang    = $data['pengarang'];
            //     $BukuRepo->save();
            //     $result["status"] = true;
            //     $result["message"] = "data Berhasil disimpan";
            // } catch (\Throwable $th) {
            //     $result["message"] =  'Funtion Store Error'.$th->getMessage();
            //     return $result;
            // }
        }

        public function findById($id){
            return Perpus::with([])
                ->find($id);
        }

        public function getData($request){
            return Perpus::where('judul', 'LIKE', '%'.$request->cari.'%')
            ->orwhere('kategori', 'LIKE', '%'.$request->cari.'%')
            ->orwhere('stok', 'LIKE', '%'.$request->cari.'%')
            ->orwhere('deskripsi', 'LIKE', '%'.$request->cari.'%')
            ->orwhere('pengarang', 'LIKE', '%'.$request->cari.'%')
            ->paginate(2);
        }

        public function pinjamBuku($request = []){
            $result = ["status" => false, "message" => ""];
            try {
                Status::create($request);
                $result["status"] = true;
                $result["message"] = "data Berhasil disimpan";
                return $result;
            } catch (\Throwable $th) {
                $result["message"] =  'Funtion Store Error'.$th->getMessage();
                return $result;
            }
        }

        public function statusStok($request, $id){
                try {
                    $buku_id = $id->perpus_id;
                    $this->statusRepo->updateStatus($request, $id);
                    $stok = new Perpus;
                    $stok = $stok->findStokById($buku_id);
                    if($request['status'] == 'Approve'){
                        $stok->stok = $stok->stok - 1;
                    }else if($request['status'] == 'dikembalikan'){
                        $stok->stok = $stok->stok + 1;
                    }
                    $stok->save();
                    $result["status"] = true;
                    $result["message"] = "data Berhasil disimpan";
                    return $result;
                } catch (\Throwable $th) {
                    $result["message"] =  'Funtion Store Error'.$th->getMessage();
                    return $result;
                }
        }

        // public function statusStokKurang($request, $id){
        //     $result = ["status" => false, "message" => ""];
        //         try {
        //             $buku_id = $id->perpus_id;
        //             $this->statusRepo->updateStatus($request, $id);
        //             $stok = new Perpus;
        //             $stok = $stok->findStokById($buku_id);
        //             $stok->stok = $stok->stok - 1;
        //             $stok->save();
        //             $result["status"] = true;
        //             $result["message"] = "data Berhasil disimpan";
        //             return $result;
        //         } catch (\Throwable $th) {
        //             $result["message"] =  'Funtion Store Error'.$th->getMessage();
        //             return $result;
        //         }
        //     }

        // public function statusStokTambah($request, $id){
        //     // dd($request);
        //     $result = ["status" => false, "message" => ""];
        //         try {
        //             $buku_id = $id->perpus_id;
        //             $this->statusRepo->updateStatus($request, $id);
        //             $stok = new Perpus;
        //             $stok = $stok->findStokById($buku_id);
        //             $stok->stok = $stok->stok + 1;
        //             $stok->save();
        //             $result["status"] = true;
        //             $result["message"] = "data Berhasil disimpan";
        //             return $result;
        //         } catch (\Throwable $th) {
        //             $result["message"] =  'Funtion Store Error'.$th->getMessage();
        //             return $result;
        //         }
        // }

        public function hapusBuku($id){
            $result = ["status" => false, "message" => ""];
            try {
                $blog = Perpus::find($id);
                $blog->delete();
                $result["status"] = true;
                $result["message"] = "data Berhasil disimpan";
                return $result;
            } catch (\Throwable $th) {
                $result["message"] =  'Funtion Store Error'.$th->getMessage();
                return $result;
            }
        }

        public function statusPinjam(){
            return Status::with(['perpus', 'user'])->where('status', 'Peminjaman')->get();
        }
        
        public function getByDeletedStatus(){
        return Status::where('user_id', Auth::user()->id) 
        ->where('status', '<>',"hapus")
        ->with(['perpus', 'user'])  
        ->get();
        }
}