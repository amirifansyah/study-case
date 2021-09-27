@extends('master')
@section('content')
<link rel="stylesheet" href="//cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css">

<div class="container" style="margin-top: 50px">
    <div class="row">
        <div class="col-md-12">
            <div class="create">
                <a href="{{route('create.pustaka')}}" class="btn btn-secondary"><i class="fas fa-plus"></i> Create New</a>
            </div>
            <div class="content" style="margin-top: 20px">
                <table class="table table-dark table-striped" id="myTable">
                    <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Penulis</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($buku as $item)    
                        <tr>
                            <th scope="col">{{$loop->iteration}}</th>
                            <th scope="col"><img src="{{asset('storage/gambar-buku/'. $item->gambar)}}" width="50px" alt="Gambar"></th>
                            <th scope="col">{{$item->judul_buku}}</th>
                            <th scope="col">{{$item->stok}}</th>
                            <th scope="col">{{$item->desc}}</th>
                            <th scope="col">{{$item->kategori}}</th>
                            <th scope="col">{{$item->pengarang}}</th>
                            <th scope="col">
                                <a href="{{route('create.pustaka', ['id' => $item->id])}}" class="btn btn-success"><i class="far fa-edit"></i></a>
                            </th>
                            <th scope="col">
                                <form action="{{route('destroyBuku.pustaka', ['id' => $item->id])}}" method="POST">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button class="btn btn-danger" onclick="return confirm('Apakah Kamu Yakin Menghapus Buku ini ?')" style="font-size: 14px"><i class="far fa-trash-alt"></i></button>
                                </form>
                            </th>

                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

  <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
</script>
@endsection