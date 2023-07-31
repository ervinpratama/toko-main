@extends('customer.layout')

@section('content')

<div class="container">
    <h3>List History</h3>
        <hr/>
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <form action="" method="GET">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="order_id" id="order_id" value="<?= $order_id ?>" placeholder="ORDER ID">
                        </div>
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="nama" id="nama" value="<?= $nama ?>" placeholder="Nama Customer">
                        </div>
                        <div class="col-md-2">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-block">Filter</button>
                            </div>
                        </div>
                    </div>
                    </form>
                  <table class="table mt-4" style="white-space:nowrap;">
                    <thead>
                        <tr class="text-center">
                            <th class="text-center" width="5%">No</th>
                            <th class="text-center" width="20%">ORDER ID</th>
                            <th class="text-center" width="15%">Pembeli</th>
                            <th class="text-center" width="25%">Alamat Pengiriman</th>
                            <th class="text-center" width="15%">Nomor HP</th>
                            <th class="text-center" width="10%">Status</th>
                            <th class="text-center" width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($list) && !empty($list))
                        @php
                        $no = 1;
                        @endphp
                        @foreach($list as $row)
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td class="text-center"><?= $row['order_id'] ?></td>
                            <td class="text-center"><?= $row['nama'] ?></td>
                            <td class="text-center"><?= $row['alamat'] ?></td>
                            <td class="text-center"><?= $row['no_hp'] ?></td>
                            <td class="text-center">
                            @if (isset($row['status_r']) && $row['status_r'] == "pending")
                            <span class="badge bg-danger">Rejected Pending</span>
                            @elseif (isset($row['status_r']) && $row['status_r'] == "Reject diterima")
                            <span class="badge bg-danger">Pembatalan Diterima</span>
                            @elseif (isset($row['status_r']) && $row['status_r'] == "Reject ditolak")
                            <span class="badge bg-danger">Pembatalan Ditolak</span>
                            @elseif (isset($row['status_r']) && $row['status_r'] == "Pending Refund")
                            <span class="badge bg-warning">Pending Refund</span>
                            @elseif (isset($row['status_r']) && $row['status_r'] == "Selesai")
                            <span class="badge bg-success">Refund Selesai</span>
                            @elseif ($row['status_b'] == null)
                            <span class="badge bg-danger">Belum Ada Bukti Pembayaran</span>
                            @elseif ($row['status_b'] == "Pending Refund")
                            <span class="badge bg-warning">Pending Refund</span>
                            @elseif ($row['status_b'] == "acc")
                            <span class="badge bg-success">Diterima</span>
                            @elseif ($row['status_b'] == "dikirim")
                            <span class="badge bg-success">Dikirim</span>
                            @elseif ($row['status_b'] == "Selesai")
                            <span class="badge bg-success">Refund Selesai</span>
                            @elseif ($row['status_b'] == "Refund Selesai")
                            <span class="badge bg-success">Refund Selesai</span>
                            @elseif ($row['status_b'] == "dibatalkan")
                            <span class="badge bg-danger">Dibatalkan</span>
                            @elseif ($row['status_b'] == "selesai" && !isset($row['status_r']))
                            <span class="badge bg-info">Selesai</span>
                            @else
                            <span class="badge bg-warning text-dark">Pending</span>
                            @endif
                            </td>
                            <td class="text-center">
                                @if (isset($row['status_r']) && $row['status_r'] == "Selesai")
                                <button class="btn btn-primary btn-sm" data-gambar="{{$row['refund_r']}}" id="bukti_refund"><i class="fa fa-eye"></i> Bukti Refund</button>
                                @elseif($row['status_b'] == "Selesai")
                                <button class="btn btn-primary btn-sm" data-gambar="{{$row['refund_b']}}" id="bukti_refund"><i class="fa fa-eye"></i> Bukti Refund</button>
                                @endif
                                <a href="/transaction/detail/{{ $row['id'] }}" class="btn btn-success btn-sm">Detail</a>
                                @if(!isset($row['status_b']) || $row['status_b'] == 'pending' && !isset($row['status_b']))
                                <a href="/transaction/upload_bukti_transfer/{{ $row['id'] }}" class="btn btn-sm btn-primary">Upload</a>
                                <a onclick = "if (! confirm('Batalkan Pesanan?')) { return false; }" href="/transaction/batalkan_pesanan/{{ $row['id'] }}" class="btn btn-sm btn-danger">Batalkan</a>
                                @elseif(isset($row['status_b']) && $row['status_b'] == "dikirim")
                                <a onclick = "if (! confirm('Terima Pesanan?')) { return false; }" href="/transaction/terima_pesanan/{{ $row['id'] }}" class="btn btn-sm btn-warning">Terima</a>
                                @elseif(isset($row['status_b']) && $row['status_b'] == "acc")
                                <a onclick = "if (! confirm('Batalkan Pesanan?')) { return false; }" href="/transaction/batalkan_pesanan/{{ $row['id'] }}" class="btn btn-sm btn-danger">Batalkan</a>
                                @elseif(isset($row['status_b']) && $row['status_b'] == "selesai" && !isset($row['status_r']))
                                <a href="/transaction/reject/{{ $row['id'] }}" class="btn btn-sm btn-danger">Reject</a>
                                @else
                                @endif

                                @if(isset($row['status_r']) && $row['status_r'] == "Reject diterima")
                                <a href="/transaction/reject_upload/{{ $row['reject_id'] }}" class="btn btn-sm btn-danger">Upload Rekening</a>
                                @endif
                                @if(isset($row['status_b']) && $row['status_b'] == "dibatalkan")
                                <a href="/transaction/batal_upload/{{ $row['bukti_id'] }}" class="btn btn-sm btn-danger">Upload Rekening</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
</div>
<!-- Modal -->
<div class="modal fade" id="buktirefundmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Bukti Refund</h5>
          <button type="button" class="close closes" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" >
          <img src="" alt="" id="bukti" width="100%">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary closes" data-dismiss="modal" id="close">Close</button>
        </div>
      </div>
    </div>
  </div>
@endsection
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script>
$(document).ready(function(){
    $('#bukti_refund').on('click', function(e){
        let path = `<?= asset('bukti_refund') ?>`;
        
        let gambar = $(this).data('gambar');
        $('#buktirefundmodal').modal('show');
        $('#bukti').attr('src', `${path}/${gambar}`)
    })
    $('.closes').on('click', function(e){
        $('#buktirefundmodal').modal('hide');
    })
})
</script>
