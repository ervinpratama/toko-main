@extends('layouts.app')

@section('title', 'Form Pengrajin')

@section('contents')
    <form action="{{ isset($pengrajin) ? route('pengrajin.tambah.update', $pengrajin->id) : route('pengrajin.tambah.simpan') }}"
          method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ isset($pengrajin) ? 'Form Edit Pengrajin' : 'Form Tambah Pengrajin' }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama_pengrajin">Nama Pengrajin</label>
                            <input required type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"
                                   value="{{ isset($pengrajin) ? $pengrajin->nama : '' }}">
                            @error('nama')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="harga">Kerajinan</label>
                            <input required type="text" class="form-control @error('kerajinan') is-invalid @enderror" id="kerajinan" name="kerajinan"
                                   value="{{ isset($pengrajin->kerajinan) ?  $pengrajin->kerajinan  : '' }}">
                            @error('harga')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="ukuran">Jumlah</label>
                            <input required type="number" class="form-control @error('total') is-invalid @enderror" id="total" name="total"
                                   value="{{ isset($pengrajin) ? $pengrajin->total : '' }}">
                            @error('total')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection