<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use Alert;
use PDF;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = Transaction::groupBy('code')->get();
		return view('admin.transaction.index',compact('transaction'));
    } 

    public function statusPengiriman($code, $status){
		$transaction = Transaction::where('code',$code)->pluck('id')->toArray();
		Transaction::whereIn('id',$transaction)->update(['status_pengiriman' => $status]);
		Alert::success('', 'Status Pengiriman berhasil di perbarui');
        return redirect('admin/transaction');
    }

    public function statusPembayaran($code ,$status){
		$transaction = Transaction::where('code',$code)->pluck('id')->toArray();
		Transaction::whereIn('id',$transaction)->update(['status_pembayaran' => $status]);
		Alert::success('', 'Status Pembayaran berhasil di perbarui');
        return redirect('admin/transaction');
    }
    
    public function print($code){
		$transaction = Transaction::groupBy('code')->orderBy('id','DESC')->where('code',$code)->first();
		$transactiondetail = Transaction::orderBy('id','DESC')->where('code',$code)->get();
		return view('admin.transaction.print',compact('transaction','transactiondetail'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $transaction = Transaction::groupBy('code')->orderBy('id','DESC')->where('code',$code)->first();
		$transactiondetail = Transaction::orderBy('id','DESC')->where('code',$code)->get();
		return view('admin.transaction.show',compact('transaction','transactiondetail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
