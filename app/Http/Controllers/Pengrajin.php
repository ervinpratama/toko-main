<?php

namespace App\Http\Controllers;

use App\Models\PengrajinModel;
use Illuminate\Http\Request;

class Pengrajin extends Controller
{
    public function index()
	{
		$data = PengrajinModel::all();
		return view('pengrajin.index', ['data' => $data]);
	}

    public function tambah()
	{
		return view('pengrajin.form');
	}

    public function simpan(Request $request)
	{
		$data = [
			'nama' => $request->nama,
			'kerajinan' => $request->kerajinan,
			'total' => $request->total,
		];
		$pengrajin = PengrajinModel::create($data);
		return redirect()->route('pengrajin');
	}


    public function edit($id)
	{
		$pengrajin = PengrajinModel::find($id);

		return view('pengrajin.form', ['pengrajin' => $pengrajin]);
	}

    public function update($id, Request $request)
	{
        $data = [
            'nama' => $request->nama,
            'kerajinan' => $request->kerajinan,
            'total' => $request->total,
        ];

		PengrajinModel::find($id)->update($data);
		return redirect()->route('pengrajin');
	}



    public function hapus($id)
	{
		PengrajinModel::find($id)->delete();
		return redirect()->route('pengrajin');
	}
}
