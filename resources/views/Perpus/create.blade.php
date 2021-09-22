@extends('master')
@section('name', 'Create New')
@section('content')
   
<div class="container" style="margin-top: 30px">
    <div class="row">
        <div class="col-md-12">
            <form action="{{route('perpus.store')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="modal-body">   
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror">
                                </div>
                                {{-- <div class="mb-3">
                                    <label for="gambar" class="form-label">Gambar</label>
                                    <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror">
                                </div> --}}
                                <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" rows="3" class="form-control @error('deskripi') is-invalid @enderror"></textarea>
                                </div>
                                <div class="mb-3">
                                <label for="stok" class="form-label">Stok</label>
                                <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror">
                                </div>
                                <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <input type="text" name="kategori" class="form-control @error('kategori') is-invalid @enderror">
                                </div>
                                <div class="mb-3">
                                <label for="pengarang" class="form-label">Pengarang</label>
                                <input type="text" name="pengarang" class="form-control @error('pengarang') is-invalid @enderror">
                                </div>
                                    {{-- <div class="mb-3">
                                        <div class="form-group">
                                            <label for="status"><b>Status</b> </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="jenis_kelamin" value="1" {{old('jenis_kelamin')}}>
                                            <label class="form-check-label"> Ready </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="status" value="0" {{old('status')}}>
                                            <label class="form-check-label"> Empty </label>
                                        </div>
                                    </div> --}}
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
