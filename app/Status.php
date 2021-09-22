<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $guarded = [];

    public function perpus(){
        return $this->belongsTo(Perpus::class, 'perpus_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // public function findStokById($id){
    //     return $this->where('id', $id)->first();
    // }
}
