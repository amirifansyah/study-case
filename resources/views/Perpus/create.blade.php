@extends('master')
@section('name', 'Create New')
@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="container" style="margin-top: 30px">
    <div class="row">
        <div class="col-md-12">
            @if (isset($id))
                <form action="{{route('perpus.store', $id->id)}}" method="POST">    
            @endif

            <form action="{{route('perpus.store')}}" method="POST">
                {{ csrf_field() }}
                    <div class="modal-body">   
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" name="judul" class="form-control" value="{{$id->judul}}">
                                {{-- {{dd($id)}} --}}
                                </div>
                                <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" rows="3" class="form-control">{{$id->deskripsi}}</textarea>
                                </div>
                                <div class="mb-3">
                                <label for="stok" class="form-label">Stok</label>
                                <input type="number" name="stok" class="form-control" value="{{$id->stok}}">
                                </div>
                                <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <input type="text" name="kategori" class="form-control" value="{{$id->kategori}}">
                                </div>
                                <div class="mb-3">
                                <label for="pengarang" class="form-label">Pengarang</label>
                                <input type="text" name="pengarang" class="form-control" value="{{$id->pengarang}}">
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>

@endsection
