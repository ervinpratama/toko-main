@extends('layouts.app')

@section('title', 'Data Pengrajin')

@section('contents')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pengrajin</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    @if (auth()->user()->level == 'Penjual')
                        <a href="{{ route('pengrajin.tambah') }}" class="btn btn-primary mb-3">Tambah Pengrajin</a>
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
                        <th style="text-align:center">Nama Pengrajin</th>
                        <th style="text-align:center">Kerajinan</th>
                        <th style="text-align:center">Jumlah</th>
                        
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
                            <td style="text-align:center">{{$row->nama}}</td>
                            <td style="text-align:center">{{$row->kerajinan}}</td>
                            <td style="text-align:center">{{$row->total}}</td>
                            @if (auth()->user()->level == 'Penjual')
                                <td style="text-align:center">
                                    <a href="{{ route('pengrajin.edit', $row->id) }}" class="btn btn-warning">Edit</a>
                                    <a href="{{ route('pengrajin.hapus', $row->id) }}" class="btn btn-danger">Hapus</a>
                                </td>
                            @endif
                        </tr>
                        @endforeach
                    @else
                    <tr>
                        <td colspan="5" style="text-align:center">No Available Data.</td>
                    </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>