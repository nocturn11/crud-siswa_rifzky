@extends('layout.template');
<div class="container">
    <div class="row">
                <!-- START DATA -->
                @section('konten')
                <div class="my-3 p-3 bg-body rounded shadow-sm">
                    <!-- FORM PENCARIAN -->
                    <div class="pb-3">
                      <form class="d-flex" action="{{url('siswa')}}" method="get">
                          <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
                          <button class="btn btn-secondary" type="submit">Cari</button>
                      </form>
                    </div>
                    
                    <!-- TOMBOL TAMBAH DATA -->
                    <div class="pb-3">
                      <a href='{{ url('siswa/create') }}' class="btn btn-primary">+ Tambah Data</a>
                    </div>
              
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="col-md-1">No</th>
                                <th class="col-md-3">NIS</th>
                                <th class="col-md-4">Nama</th>
                                <th class="col-md-2">Kelas</th>
                                <th class="col-md-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = $data->firstItem() ?>
                            @foreach ($data as $item)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $item->nis }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->kelas }}</td>
                                <td>
                                    <a href='{{ url('siswa/'.$item->nis.'/edit') }}' class="btn btn-warning btn-sm">Edit</a>
                                    <form onsubmit="return confirm('Yakin akan menghapus data?')" action="{{url('siswa/'.$item->nis)}}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" name='submit' class="btn btn-danger btn-sm">Del</button>
                                    </form>
                                </td>
                            </tr>
                            <?php $i++ ?>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $data->withQueryString()->links() }}
                </div>
                @endsection     
              <!-- AKHIR DATA -->
    
    </div>
</div>