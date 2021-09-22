<?php

namespace App\Http\Repositories;

use App\Login;

class LoginRepository{

    public function loginstore($request = []){
        // dd($request['name']);
        $result = ["status" => false, "message" => "" ];
        try {
            $LoginRepo = new Login();
            $LoginRepo->name = $request["name"];
            $LoginRepo->email = $request["email"];
            $LoginRepo->save();
            //response
            $result["status"] = true;
            $result["message"] = "Data berhasil di simpan";
            return $result;
        } catch (\Throwable $th) {
            // $result["message"] = $th->getMessage();
            $result["message"] = "maaf, data gagal disimpan! Coba lagi";
            return $result;
        }
    }

}