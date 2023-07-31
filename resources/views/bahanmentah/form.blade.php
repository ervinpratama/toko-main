@extends('layouts.app')

@section('title', 'Form Bahan Mentah')

@section('contents')
    <form action="{{ isset($bahan) ? route('bahan_mentah.tambah.update', $bahan->id) : route('bahan_mentah.tambah.simpan') }}"
          method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ isset($bahan) ? 'Form Edit Bahan Mentah' : 'Form Tambah Bahan Mentah' }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="jenis">Jenis Bahan Mentah</label>
                            <select required onchange="jenis_change(this)" name="jenis" id="jenis" class="form-control @error('jenis') is-invalid @enderror">
                                <option value="">-Pilih Jenis Bahan Mentah-</option>
                                <option value="1" <?= (isset($bahan) && $bahan->jenis == 1) ? 'selected' : '' ?>>Bahan Mentah Panen</option>
                                <option value="2" <?= (isset($bahan) && $bahan->jenis == 2) ? 'selected' : '' ?>>Bahan Mentah Beli</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="berat">Berat (Kg)</label>
                            <input required type="text" class="form-control @error('berat') is-invalid @enderror" id="berat" name="berat"
                                   value="{{ isset($bahan->berat) ?  $bahan->berat  : '' }}">
                            @error('berat')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="bambu">Jenis Bambu</label>
                            <input required type="text" class="form-control @error('bambu') is-invalid @enderror" id="bambu" name="bambu"
                                   value="{{ isset($bahan->bambu) ?  $bahan->bambu  : '' }}">
                            @error('bambu')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group" id="harga_form">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
    cek_jenis();
    function jenis_change(input){
        cek_jenis();
    }
    function cek_jenis(){
        let val = $('#jenis').val();
        if(val == 2){
            let html = `<label for="harga">Harga</label><input required type="number" class="form-control" id="harga" name="harga" value="{{ isset($bahan) ? $bahan->harga : '' }}">`
            $('#harga_form').html(html);
        }else{
            $('#harga_form').html('');
        }
    }
</script>
@endsection
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

