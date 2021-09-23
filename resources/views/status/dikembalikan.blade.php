@extends('master')
@section('name', 'History')
@section('content')
<link rel="stylesheet" href="//cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css">
 
    
    <div class="container" style="margin-top: 30px">
        <div class="row">
            <div class="col-md 12"> 
                        @if (session('pesan'))
                        <div class="alert alert-success">
                            {{ session('pesan') }}
                        </div>
                        @endif
                    <table class="table table-striped" id="myTable">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th>Nama</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Status</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Jam</th>
                            <th scope="col">Keterangan</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($status as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->user->name}}</td>
                                    <td>{{ $item->perpus->judul}}</td>
                                    <td>{{ $item->status}}</td>
                                    <td>{{$item->updated_at->format('d-M-Y')}}</td>
                                    <td>{{$item->updated_at->format('H:i')}}</td>
                                    <td>{{ ($item->status == 'dikembalikan') ? 'sudah kembali' : ''}}</td>
                                    {{-- <td>
                                        <form action="{{route('status.update', $item->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('PATCH') }}
                                                <input type="text" name="status" value="return" hidden>                                            
                                                <input type="text" name="user_id" value="{{$item->user->name}}" hidden>
                                                <input type="text" value="{{$item->perpus->judul}}" name="perpus_id" hidden>
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Kamu Yakin Buku Ini Sudah Dikembalikan ?')">Di Kembalikan</button>
                                        </form>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
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