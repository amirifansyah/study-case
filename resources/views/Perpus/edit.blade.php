@extends('master')
@section('content')
   
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="{{route('perpus.update', $id->id)}}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                    <div class="modal-body">   
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul</label>
                                    <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ $id->judul}}">
                                </div>
                                {{-- <div class="mb-3">
                                    <label for="gambar" class="form-label">Gambar</label>
                                    <img src="{{asset('storage/gambar-buku/'.$id->gambar)}}" width="80px" alt="">
                                    <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror">
                                </div> --}}
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea name="deskripsi" rows="3" class="form-control @error('deskripi') is-invalid @enderror">{{ $id->deskripsi}}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="stok" class="form-label">Stok</label>
                                    <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror" value="{{ $id->stok}}">
                                </div>
                                <div class="mb-3">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <input type="text" name="kategori" class="form-control @error('kategori') is-invalid @enderror" value="{{ $id->kategori}}">
                                </div>
                                <div class="mb-3">
                                    <label for="pengarang" class="form-label">Pengarang</label>
                                    <input type="text" name="pengarang" class="form-control @error('pengarang') is-invalid @enderror" value="{{ $id->pengarang}}">
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
