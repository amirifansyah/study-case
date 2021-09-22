<?php

namespace App\Http\Controllers;

use App\Http\Repositories\LoginRepository;
use App\Http\Requests\StoreDataLogin;
use App\Jobs\StoreDataUser;
use Session;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $LoginRepo;

    public function __construct()
    {
        $this->LoginRepo = new LoginRepository;
    }

    public function index(){
        return view('front.login');
    }

    public function store(StoreDataLogin $request){
        $SendDataUser = dispatch(new StoreDataUser($request->name, $request->email));
        dd($SendDataUser);


        // $store = $this->LoginRepo->loginstore($request->all());
        // Session::flash('message', $store['message']);
        // if(!$store['status']){
        //     Session::flash('alert-class', 'alert-danger');
        // }else{
        //     Session::flash('alert-class', 'alert-success');
        // }
        // return back();
    }
}
