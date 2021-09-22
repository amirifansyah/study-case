<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perpus extends Model
{
    protected $table = 'perpuses';

    protected $guarded = [];

    public function pinjam(){
        return $this->hasMany(Status::class, 'perpus_id', 'id');
    }

     public function findStokById($id){
        return $this->where('id', $id)->first();
    }
}
