<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\Distributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = BarangMasuk::with(['user', 'barang', 'distributor'])->get();
        // dd($data);

        return view('karyawan.barangmasuk.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['distributors'] = Distributor::all();
        $data['barangs'] = Barang::all();
        // dd($data);
        return view('karyawan.barangmasuk.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'id_distributor' => 'required|numeric|exists:distributors,id',
            'id_barang' => 'required|numeric|exists:barangs,id',
            'jumlah_masuk' => 'required|numeric|min:1'

        ]);

        $validatedData['id_user'] = Auth::user()->id;
        BarangMasuk::create($validatedData);

        $data = Barang::findOrFail($request->id_barang);
        $data->update(['stok' => $data->stok + $request->jumlah_masuk]);

        return redirect()->route('barangmasuk.index')->with('success', 'Type berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = BarangMasuk::findOrFail($id);
        $barang = Barang::findOrFail($data->id_barang);
        $barang->update(['stok' => $barang->stok - $data->jumlah_masuk]);
        $data->delete();
        return redirect()->route('barangmasuk.index')->with('success', 'Barang Masuk berhasil dihapus.');
    }

    public function getBarang($id)
    {
        $data = Barang::with(['type', 'merek'])->find($id);
        // dd($data);

        return response()->json([
            'stok' => $data->stok,
            'merek' => $data->merek->nama,
            'type' => $data->type->nama,
        ]);
    }
}
