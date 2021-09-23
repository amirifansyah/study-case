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

        public function storeBuku($request){
            $result = ["status" => false, "message" => ""];
            $data = $request->all();
            try { 
                $BukuRepo = new Perpus();
                $BukuRepo->judul        = $data['judul'];
                $BukuRepo->deskripsi    = $data['deskripsi'];
                $BukuRepo->stok         = $data['stok'];
                $BukuRepo->kategori     = $data['kategori'];
                $BukuRepo->pengarang    = $data['pengarang'];
                $BukuRepo->save();
                $result["status"] = true;
                $result["message"] = "data Berhasil disimpan";
            } catch (\Throwable $th) {
                $result["message"] =  'Funtion Store Error'.$th->getMessage();
                return $result;
            }
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

        public function statusStokKurang($request, $id){
            $result = ["status" => false, "message" => ""];
                try {
                    $buku_id = $id->perpus_id;
                    $this->statusRepo->updateStatus($request, $id);
                    $stok = new Perpus;
                    $stok = $stok->findStokById($buku_id);
                    $stok->stok = $stok->stok - 1;
                    $stok->save();
                    $result["status"] = true;
                    $result["message"] = "data Berhasil disimpan";
                    return $result;
                } catch (\Throwable $th) {
                    $result["message"] =  'Funtion Store Error'.$th->getMessage();
                    return $result;
                }
            }

        public function statusStokTambah($request, $id){
            $result = ["status" => false, "message" => ""];
                try {
                    $buku_id = $id->perpus_id;
                    $this->statusRepo->updateStatus($request, $id);
                    $stok = new Perpus;
                    $stok = $stok->findStokById($buku_id);
                    $stok->stok = $stok->stok + 1;
                    $stok->save();
                    $result["status"] = true;
                    $result["message"] = "data Berhasil disimpan";
                    return $result;
                } catch (\Throwable $th) {
                    $result["message"] =  'Funtion Store Error'.$th->getMessage();
                    return $result;
                }
        }

        public function updateBuku($request, $id){
            $result = ["status" => false, "message" => ""];
            try {
                $validate = $request->all();
                $id->update($validate);
                $result["status"] = true;
                $result["message"] = "data Berhasil disimpan";
                return $result;
            } catch (\Throwable $th) {
                $result["message"] =  'Funtion Store Error'.$th->getMessage();
                return $result;
            }
        }

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