<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use Alert;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('admin.supplier.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.supplier.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $supplier = new Supplier;
        $supplier->name = $request->name;
        $supplier->phone = $request->phone;
        $supplier->email = $request->email;
        $supplier->description = $request->description;
        
        $supplier->save();
        Alert::success('', 'Supplier Berhasil di Tambahkan');
        return redirect('admin/supplier');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        $supplier = Supplier::find($supplier->id);
        return view('admin.supplier.edit', compact('supplier', 'supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $supplier = Supplier::find($supplier->id);
        $supplier->name = $request->name;
        $supplier->description = $request->description;
        $supplier->phone = $request->phone;
        $supplier->email = $request->email;
        $supplier->save();
        Alert::success('', 'Supplier Berhasil di Update');
        return redirect('admin/supplier');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier = Supplier::find($supplier->id);
        $supplier->delete();
        Alert::success('', 'Supplier Berhasil di delete');
        return redirect('admin/supplier');
    }
}
