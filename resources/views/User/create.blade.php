@extends('master')
@section('name', 'History')
@section('content')
<link rel="stylesheet" href="//cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css">
    
    <div class="container" style="margin-top: 30px">
        <div class="row">
            <div class="col-md 12">
                    <h1 class="display-5">Daftar buku yang kamu pinjam </h1>      
                        @if (session('pesan'))
                            <div class="alert alert-success">
                                {{ session('pesan') }}
                            </div>
                        @endif
                        
                    <table class="table table-striped" id="myTable">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            @if (Auth::user()->role == 'admin')
                                <th>Nama </th>
                            @endif
                            <th scope="col">Judul</th>
                            <th scope="col">Status</th>
                            <th>Date</th>
                            @if ($status->contains('status', 'Approve'))
                                <th>pengenbalian</th>
                            @endif
                            @if (Auth::user()->role == 'admin')
                                <th scope="col">Action</th>                               
                            @endif
                            @if ($status->contains('status', 'cancle'))
                                <th>Hapus</th>
                            @endif
                            @if (Auth::user()->role == 'admin')
                                <th>Dibatalkan</th>
                            @endif
                            {{-- @php
                             $data = false;

                                foreach ($status as $item) {
                                    if ($item->status == 'cancle') {
                                       $data = true;
                                    }
                                }
                            @endphp
                            @if ($data === true)
                                <th>Hapus</th>
                            @endif --}}
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($status as $item)

                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                @if (Auth::user()->role == 'admin')
                                    <td>{{$item->user->name}}</td>
                                @endif
                                <td>{{$item->perpus->judul}}</td>
                                <td>{{$item->status}}</td>
                                <td>{{$item->created_at->format('d-M-Y')}}</td>
                                @if ($item->status == 'Approve')
                                   <td>{{date("d-M-Y", strtotime("+3 days", strtotime($item->updated_at)))}}</td>
                                @endif
                                @if (Auth::user()->role == 'admin')
                                <td>
                                    <form action="{{route('status.update', $item->id)}}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('PATCH') }}
                                            <input type="text" name="status" value="Approve" hidden>                                            
                                            <input type="text" name="user_id" value="{{$item->user->name}}" hidden>
                                            <input type="text" value="{{$item->perpus->judul}}" name="perpus_id" hidden>
                                        <button type="submit" class="btn btn-success" onclick="return confirm('Apakah Kamu Yakin mengizinkan Buku ini dipinjam?')">Approve</button>
                                    </form>
                                </td> 
                                <th>
                                    <form action="{{route('status.update', $item->id)}}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('PATCH') }}
                                            <input type="text" name="status" value="cancle" hidden>                                            
                                            <input type="text" name="user_id" value="{{$item->user->name}}" hidden>
                                            <input type="text" value="{{$item->perpus->judul}}" name="perpus_id" hidden>
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Kamu Yakin membatalkan pinjaman?')"><i class="far fa-window-close"></i></button>
                                    </form>
                                </th>
                                @endif
                                @if ($item->status == 'cancle')
                                    <td>
                                        <form action="{{route('status.update', $item->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('PATCH') }}
                                                <input type="text" name="status" value="hapus" hidden>                                            
                                                <input type="text" name="user_id" value="{{$item->user->name}}" hidden>
                                                <input type="text" value="{{$item->perpus->judul}}" name="perpus_id" hidden>
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Kamu Yakin membatalkan pinjaman?')"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                @endif
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