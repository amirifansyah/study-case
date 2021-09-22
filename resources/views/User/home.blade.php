@extends('master')
@section('name', 'Daftar Buku')
@section('content')
<div class="container" style="margin-top: 30px">
    <div class="col-md-12">
        <div class="row">
                @if (session('pesan'))
                <div class="alert alert-success">
                    {{ session('pesan') }}
                </div>
                @endif
                <div class="d-flex justify-content-center">
                    <a href="{{route("user.pinjambuku")}}" class="btn btn-primary" style="color: white">History</a>
                        <form class="d-flex" style="margin-left: 15px">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="cari">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                </div>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Pengarang</th>
                    <th scope="col">Status</th>
                    <th scope="col">Request</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($perpuses as $key => $item)
                        <tr>
                            <td>{{ $perpuses->firstItem() + $key }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->kategori }}</td>
                            <td>{{ $item->pengarang }}</td>
                            <td><label>{{ ($item->stok >= 1) ? 'Ready' : 'Empty' }}</label></td>
                            <td>
                                {{-- {{ ($item->stok >= 1) ? $item->stok : ''}} --}}
                                    @if ($item->stok >= 1)
                                        <a href="{{route('user.show', $item->id)}}" style="color: white" class="btn btn-success">Pinjam</a>
                                    @endif
                                    @if ($item->stok == 0)
                                        <a href="{{route('user.show', $item->id)}}" style="color: white" class="btn btn-primary">View</a>
                                    @endif
                            </td>
                        </tr>
                    @empty
                        
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
@endsection
