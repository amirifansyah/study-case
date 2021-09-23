@extends('master')
@section('name', 'Admin PerPus')
@section('content')
{{-- <link rel="stylesheet" href="//cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css"> --}}


<div class="container" style="margin-top: 30px">
  <div class="row">
    <div class="col-sm-12">
      <div>
        @if (Session::has('message'))
          <p class="alert {{ Session::get('alert-class', 'alert-info')}}">{{Session::get('message')}}</p>
        @endif
      </div>
      <div class="d-flex justify-content-center">
        <a class="btn btn-success" href="{{ route('perpus.create')}}" style="margin-right: 15px">Create New Book</a>
        <form class="d-flex" style="margin-left: 15px">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="cari">
          <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
      </div>
      <table class="table" id="myTable">
          <thead>
            <tr>
              <th scope="col">No</th>
              {{-- <th>Gambar</th> --}}
              <th scope="col">Judul</th>
              <th scope="col">Deskripsi</th>
              <th scope="col">Stok</th>
              <th scope="col">Kategori</th>
              <th scope="col">Pengarang</th>
              <th scope="col">status</th>
              <th >Edit</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($perpuses as $key => $item)
              <tr>
                <td>{{ $perpuses->firstItem() + $key }}</td>
                {{-- <td><img src="{{asset('storage/gambar-buku/'.$item->gambar)}}" width="80px" alt=""></td> --}}
                <td>{{ $item->judul }}</td>
                <td>{{ $item->deskripsi }}</td>
                <td>{{ $item->stok }}</td>
                <td>{{ $item->kategori }}</td>
                <td>{{ $item->pengarang }}</td>
                <td><label class="btn {{ ($item->stok >= 1 ) ? 'btn-success' : 'btn-danger'}}">{{ ($item->stok >= 1) ? 'Ready' : 'Empty' }}</label></td>
                <td>
                    <button class="btn btn-success"><a href="{{route('perpus.edit', $item->id)}}" style="color: white"><i class="far fa-edit"></i></a></button>
                </td>
                <td>
                  <form action="{{route('perpus.destroy', ['id' => $item->id])}}" method="POST">
                      {{ method_field('DELETE') }}
                      {{ csrf_field() }}
                            <button class="btn btn-danger" onclick="return confirm('Apakah Kamu Yakin Menghapus Buku ini ?')" style="font-size: 14px"><i class="far fa-trash-alt"></i></button>
                    </form>
                </td>
                {{-- <td>{{ date("Y-m-d H:i:s", strtotime("+3 days", strtotime(Date('Y-m-d H:i:s')))) }}</td> --}}
                {{-- <td>{{ date("Y-m-d H:i:s", strtotime("+3 days")) }}</td> --}}
                @empty
                <td colspan="7" style="text-align: center">data kosong</td>
              </tr>
            @endforelse
              
          </tbody>
        </table>
        <div>
        show
          {{ $perpuses->firstItem()}}
          to
          {{ $perpuses->lastItem()}}
          of
          {{ $perpuses->total()}}
        </div>
        <div class="d-flex justify-content-end">
          {{ $perpuses->links() }}
        </div>
    </div>
  </div>
</div>

{{-- <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
    $('#myTable').DataTable();
    } );
</script> --}}
@endsection