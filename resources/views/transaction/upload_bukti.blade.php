@extends('layouts.app')

@section('title', 'Upload Bukti Pengembalian Dana')

@section('contents')
    <form action="{{ asset('/transaction/proses_upload_bukti_refund').'/'.$refund['id'] }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Form Upload Bukti Pengembalian Dana</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama_barang">Nama Rekening</label>
                            <input required readonly class="form-control" type="text" name="nama_refund" value="<?= $refund['nama_refund'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="nama_barang">Bank</label>
                            <input required readonly class="form-control" type="text" name="bank_refund" value="<?= $refund['bank_refund'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="nama_barang">Nomor Rekening</label>
                            <input required readonly class="form-control" type="number" name="rek_refund" value="<?= $refund['rek_refund'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="gambar">Foto</label><br/>
                            <input required name="bukti" type="file" class="form-control mt-2">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection