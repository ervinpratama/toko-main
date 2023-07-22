@extends('customer.layout')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            Submit Data Rekening Penerima Refund
        </div>
        
        <div class="card-body">
            <form action="{{ asset('/transaction/proses_reject_upload').'/'.$reject['id'] }}" method="POST" enctype="multipart/form-data">
                @method('POST')
                @csrf
                <div class="form-group">
                    <label for="" class="my-2">Nama Rekening</label>
                    <input type="hidden" name="id" id="id" value="{{$reject['id']}}">
                    <input required type="text" name="nama_refund" id="nama_refund" class="form-control">
                </div>
                <div class="form-group">
                    <label for="" class="my-2">BANK</label>
                    <input required type="text" name="bank_refund" id="bank_refund" class="form-control">
                </div>
                <div class="form-group">
                    <label for="" class="my-2">Nomor Rekening</label>
                    <input required type="number" name="rek_refund" id="rek_refund" class="form-control">
                </div>
                <button type="submit" class="btn btn-success mt-3">Kirim</button>
            </form>
        </div>
    </div>
</div>
    
@endsection