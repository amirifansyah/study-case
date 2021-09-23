<?php

namespace App\Http\Repositories;

use App\Login;

class LoginRepository{

    # penamaan function pakai camelCase saja, contoh: loginStore

    public function loginstore($request = []){
        # pesan dump/dd kayak gini jangan lupa dihapus
        // dd($request['name']);
        $result = ["status" => false, "message" => "" ];
        try {
            # instansiasi class pakai camelCase saja,contoh: $loginRepository = new Login();
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