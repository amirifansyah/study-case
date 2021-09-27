@extends('master')
@section('content')

<div class="warning">
    @if(Session::has('false'))
        <div class="alert alert-danger">
            {{ Session::get('false') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

@if (isset($id))
 <form action="{{route('store.pustaka', $id->id)}}" method="POST" enctype="multipart/form-data">
@endif

<form action="{{route('store.pustaka')}}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="header" style="text-align: center">
        <h1 class="display-3">Create New Book</h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <label for="judul_buku" class="form-label">Judul</label>
                <input type="text" name="judul_buku" class="form-control" value="{{$id->judul_buku}}" >             
            </div>
            <div class="col-md-6">
                <label for="stok" class="form-label">Stok</label>
                <input type="number" name="stok" class="form-control" value="{{$id->stok}}"> 
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
                <label for="pengarang" class="form-label">Pengarang</label>
                <input type="text" name="pengarang" class="form-control " value="{{$id->pengarang}}">           
            </div>
            <div class="col-md-6">
                
                <label for="gambar" class="form-label" style="float: left">Gambar</label>
                @if ($id->gambar)
                    <img src="{{asset('storage/gambar-buku/'.$id->gambar)}}" width="90px">
                @endif
                <input type="file" name="gambar" class="form-control">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
                <label for="kategori" class="form-label">Kategori</label>
                <input type="text" name="kategori" class="form-control" value="{{$id->kategori}}">            
            </div>
            <div class="col-md-6">
                <br>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="desc" rows="3" class="form-control">{{$id->desc}}</textarea>             
            </div>
        </div>
        <div class="save" style="margin-top: 20px">
            <button type="submit" class="btn btn-primary">Simpan</button> 
        </div>
    </div>
</form>
    
@endsection