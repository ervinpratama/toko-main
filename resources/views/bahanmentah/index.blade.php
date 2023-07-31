@extends('layouts.app')

@section('title', 'Data Bahan Mentah')

@section('contents')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Bahan Mentah</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    @if (auth()->user()->level == 'Penjual')
                        <a href="{{ route('bahan_mentah.tambah') }}" class="btn btn-primary mb-3">Tambah Bahan Mentah</a>
                    @endif
                </div>
                <div class="col-md-6">
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th style="text-align:center">No</th>
                        <th style="text-align:center">Jenis Bahan</th>
                        <th style="text-align:center">Jenis Bambu</th>
                        <th style="text-align:center">Berat</th>
                        <th style="text-align:center">Harga</th>
                        @if (auth()->user()->level == 'Penjual')
                        <th style="text-align:center">Action</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($data) && !empty($data))
                        <?php $no = 1; ?>
                        @foreach($data as $row)
                        <tr>
                            <td style="text-align:center"><?= $no++ ?></td>
                            <td style="text-align:center">{{$row->jenis == 1 ? 'Bahan Mentah Panen' : 'Bahan Mentah Beli'}}</td>
                            <td style="text-align:center">{{ $row->bambu ? $row->bambu : '-'}}</td>
                            <td style="text-align:center">{{$row->berat ? $row->berat.' Kg' : '-'}}</td>
                            <td style="text-align:center">{{$row->harga ? 'Rp. '. number_format($row->harga, 0,'.','.') : '-'}}</td>
                            @if (auth()->user()->level == 'Penjual')
                                <td style="text-align:center">
                                    <a href="{{ route('bahan_mentah.edit', $row->id) }}" class="btn btn-warning">Edit</a>
                                    <a href="{{ route('bahan_mentah.hapus', $row->id) }}" class="btn btn-danger">Hapus</a>
                                </td>
                            @endif
                        </tr>
                        @endforeach
                    @else
                    <tr>
                        <td colspan="6" style="text-align:center">No Available Data.</td>
                    </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>