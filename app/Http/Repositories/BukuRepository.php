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

        public function storebuku($request){
            $result = ["status" => false, "message" => ""];
            $data = $request->all();
            try { 
                // if($request->hasFile('gambar')){
                //     // dd('test');

                //     $image      = $request->file('gambar');
                //     // $bukuname   = $data['gambar'];
                //     // $nama       = strtok($bukuname, '');
                //     $file    = time() . '.' . $image->getClientOriginalExtension();
                //     $path = $request->file('gambar')->storeAs('public/gambar-buku/', $file);

                // }
                // dd($data);
                $BukuRepo = new Perpus();
                $BukuRepo->judul        = $data['judul'];
                // $BukuRepo->gambar       = $file;
                $BukuRepo->deskripsi    = $data['deskripsi'];
                $BukuRepo->stok         = $data['stok'];
                $BukuRepo->kategori     = $data['kategori'];
                $BukuRepo->pengarang    = $data['pengarang'];
                $BukuRepo->save();
                // $BukuRepo = Perpus::create([$request->all()]);
                $result["status"] = true;
                $result["message"] = "data Berhasil disimpan";
            } catch (\Throwable $th) {
                $result["message"] =  'Funtion Store Error'.$th->getMessage();
                return $result;
            }
        }

        public function getdata($request){
            $result = ['status' => false, "message" => ""];
            try {
                $BukuRepo = Perpus::where('judul', 'LIKE', '%'.$request->cari.'%')
                    ->orwhere('kategori', 'LIKE', '%'.$request->cari.'%')
                    ->orwhere('stok', 'LIKE', '%'.$request->cari.'%')
                    ->orwhere('deskripsi', 'LIKE', '%'.$request->cari.'%')
                    ->orwhere('pengarang', 'LIKE', '%'.$request->cari.'%')
                    ->paginate(2);
                $result['status'] = true;
                $result['message'] = $BukuRepo;
                return $result;
            } catch (\Throwable $th) {
                $result["message"] =  'Funtion Error'.$th->getMessage();
                return $result;
            }
        }

        public function Pinjam($request = []){
            // dd($request);
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

        public function stokKurang($request, $id){
            $result = ["status" => false, "message" => ""];
                try {
                    $buku_id = $id->perpus_id;
                    $this->statusRepo->updatestatus($request, $id);
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

        public function stokTambah($request, $id){
            $result = ["status" => false, "message" => ""];
                try {
                    $buku_id = $id->perpus_id;
                    $this->statusRepo->updatestatus($request, $id);
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
        

        public function buttonDelete(){
        return Status::where('user_id', Auth::user()->id) 
        ->where('status', '<>',"hapus")
        ->with(['perpus', 'user'])  
        ->get();
        }
}