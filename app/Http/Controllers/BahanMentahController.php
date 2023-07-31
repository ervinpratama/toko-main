<?php

namespace App\Http\Controllers;

use App\Models\BahanMentahModel;
use Illuminate\Http\Request;

class BahanMentahController extends Controller
{
    public function index()
	{
		$data = BahanMentahModel::all();
		return view('bahanmentah.index', ['data' => $data]);
	}

    public function tambah()
	{
		return view('bahanmentah.form');
	}

    public function simpan(Request $request)
	{
		$data = [
			'jenis' => $request->jenis,
			'berat' => $request->berat,
            'bambu' => $request->bambu,
			'harga' => $request->harga,
		];
		$pengrajin = BahanMentahModel::create($data);
		return redirect()->route('bahan_mentah');
	}


    public function edit($id)
	{
		$bahan = BahanMentahModel::find($id);

		return view('bahanmentah.form', ['bahan' => $bahan]);
	}

    public function update($id, Request $request)
	{
        $data = [
            'nama' => $request->jenis,
            'berat' => $request->berat,
            'bambu' => $request->bambu,
            'harga' => $request->harga,
        ];

		BahanMentahModel::find($id)->update($data);
		return redirect()->route('bahan_mentah');
	}



    public function hapus($id)
	{
		BahanMentahModel::find($id)->delete();
		return redirect()->route('bahan_mentah');
	}
}
