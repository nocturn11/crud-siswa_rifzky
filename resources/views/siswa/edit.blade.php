@extends('layout.template');
<div class="container">
    <div class="row">
        <!-- START FORM -->
        @section('konten')
        <form action='{{url('siswa/'.$data->nis)}}' method='post'>
        @csrf 
        @method('PUT')
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <a href="{{url('siswa')}}" class='btn btn-secondary mb-4'><< Kembali</a>
            <div class="mb-3 row">
                <label for="nis" class="col-sm-2 col-form-label">NIS</label>
                <div class="col-sm-10">
                    {{ $data->nis }}
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='nama' value="{{ $data->nama }}" id="nama">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='kelas' value="{{ $data->kelas }}" id="kelas">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="jurusan" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
            </div>
          </form>
        </div>
        @endsection
        <!-- AKHIR FORM -->  
    </div>
</div>