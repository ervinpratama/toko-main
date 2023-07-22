@extends('layouts.app')

@section('title', 'Data Penjual')

@section('contents')
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Penjual</h6>
    </div>
    <div class="card-body">
      <a href="{{ route('penjual.tambah') }}" class="btn btn-primary mb-3">Tambah Penjual</a>
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th class="text-center">No</th>
              <th class="text-center">Nama Penjual</th>
              <th class="text-center">Email</th>
              <th class="text-center">Status</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($penjual as $row)
            <tr>
              <th class="text-center">{{ $loop->iteration }}</th>
              <td class="text-center">{{ $row->nama }}</td>
              <td class="text-center">{{ $row->email }}</td>
              <td class="text-center"><?= $row->status == 1 ? '<span class="badge badge-success">ACTIVE</span>' : '<span class="badge badge-danger">INACTIVE</span>' ?></td>
              <td class="text-center">
                <a href="{{ route('penjual.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <a href="{{ route('penjual.hapus', $row->id) }}" class="btn btn-danger btn-sm">Hapus</a>
                <?php
                if($row->status == 1){
                ?>
                <a href="{{ route('penjual.nonaktif', $row->id) }}" class="btn btn-danger btn-sm">Non-Aktifkan</a>
                <?php
                }else{
                ?>
                <a href="{{ route('penjual.aktif', $row->id) }}" class="btn btn-success btn-sm">Aktifkan</a>
                <?php
                }
                ?>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
