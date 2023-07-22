<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
	public function register()
	{
		return view('auth/register');
	}

	public function registerSimpan(Request $request)
	{
		Validator::make($request->all(), [
			'nama' => 'required',
			'email' => 'required|email',
			'password' => 'required|confirmed',
			'role' => 'required'
		])->validate();

		User::create([
			'nama' 		=> $request->nama,
			'email' 	=> $request->email,
			'password' 	=> Hash::make($request->password),
			'level' 	=> $request->role,
			'status'	=> ($request->role == 'Penjual') ? '0' : '1'
		]);

		return redirect()->route('login');
	}

	public function login()
	{
		return view('auth/login');
	}

	public function loginAksi(Request $request)
	{
		Validator::make($request->all(), [
			'email' => 'required|email',
			'password' => 'required'
		])->validate();

		if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
			throw ValidationException::withMessages([
				'email' => trans('auth.failed')
			]);
		}

		$request->session()->regenerate();

		if(Auth::user()->level == "Penjual" || Auth::user()->level == "Super Admin") {
			if(Auth::user()->level == "Penjual" && Auth::user()->status == "0"){
				throw ValidationException::withMessages([
					'email' => "Akun Belum diaktivasi oleh Super Admin."
				]);
			}
			return redirect()->route('dashboard');
		} else {
			return redirect()->route('customer');
		}

	}

	public function logout(Request $request)
	{
		Auth::guard('web')->logout();

		$request->session()->invalidate();

		return redirect('/');
	}
}
