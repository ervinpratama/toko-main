<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\BuktiTransfer;
use App\Models\Reject;
use Illuminate\Support\Facades\Auth;

use App\Models\Barang;

class RejectController extends Controller
{
    public function index()
    {
        $transactions = Transaction::
        select('transactions.id', 'transactions.*' ,'users.nama')
        ->join('users', 'users.id', '=', 'transactions.user_id')
        ->orderBy('transactions.id', 'DESC')
        ->get();

        $transaction_id = [];

        foreach($transactions as $data){
            array_push($transaction_id, $data->id);
        }

        $reject = Reject::orderBy('id','desc')->get();
        return view('reject.index', ['transactions' => $transactions, 'reject' => $reject]);
    }

    public function upload_bukti($id){
        $data['reject'] = Reject::find($id)->toArray();
        return view('reject.upload_bukti', $data);
    }

    public function proses_upload_bukti(Request $request, $id){
        $request->validate([
            'bukti' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $imageName = time().'.'.$request->bukti->extension();

        $reject = Reject::find($id);
        $reject->bukti_refund = $imageName;
        $reject->status       = 'Selesai';
        $reject->save();
        // Public Folder
        $request->bukti->move(public_path('bukti_refund'), $imageName);
       
        return redirect('reject');
    }

    public function change_status($id, $status)
    {
        Reject::where('transaction_id', $id)->update([
            'status' => $status
        ]);
        return redirect('reject');
    }
}
