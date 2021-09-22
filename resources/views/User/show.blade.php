@extends('master')
@section('name', 'Detail Buku')
@section('content')
    <div class="container-sm" style="margin-top: 30px">
        <div class="row">
            <div class="col-sm-12">
                <table class="table">
                    <thead>
                      <tr>
                        <h3 class="d-flex justify-content-center">Detail</h3>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Judul</th>
                            <th>{{$id['judul']}}</th>
                        </tr>
                        <tr>
                            <th scope="row">Deskripsi</th>
                            <td>{{$id['deskripsi']}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Stok</th>
                            <td>{{$id['stok']}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Kategori</th>
                            <td>{{$id['kategori']}}</td>
                        </tr>
                        <tr>
                            <th scope="row">penulis</th>
                            <td>{{$id['pengarang']}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Status</th>
                            <td><label class="btn {{($id['stok'] >= 1) ? 'btn-primary' : 'btn-danger'}}">{{($id['stok'] >= 1) ? 'Ready' : 'Empty' }}</label></td>
                        </tr> 
                    </tbody>
                  </table>
            </div>
            <div class="col-md-6">
                <a href="{{route('home')}}"><button class="btn btn-primary"> Kembali </button></a>
            </div>
            @if ($id['stok'] >= 1)
                <div class="col-md-6">
                    <div class="d-flex justify-content-end">
                        <form action="{{route('user.history')}}" method="POST">
                            {{ csrf_field() }}
                            <input type="text" value="{{$id['id']}}" hidden name="perpus_id">
                            <input type="text" value="Peminjaman" hidden name="status">
                            <input type="text" name="user_id" value="{{Auth::user()->id}}" hidden>
                            <button type="submit" class="btn btn-primary">Pinjam Buku</button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
{{-- action="{{route('user.create', $id['id'])}}" --}}