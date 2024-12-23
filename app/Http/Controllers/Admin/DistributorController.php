<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Distributor;
use Illuminate\Http\Request;

class DistributorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Distributor::all();

        return view('admin.distributor.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.distributor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request);
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'notelp' => 'required|string|max:255'
        ]);

        Distributor::create($validatedData);

        return redirect()->route('distributor.index')->with('success', 'Merek berhasil ditambahkan.');
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
        $data = Distributor::findOrFail($id);
        return view('admin.distributor.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'notelp' => 'required|string|max:255'
        ]);

        $data = Distributor::findOrFail($id);
        $data->update($validatedData);

        return redirect()->route('distributor.index')->with('success', 'Distributor berhasil Edit.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Distributor::findOrFail($id);
        $data->delete();
        return redirect()->route('distributor.index')->with('success', 'Distributor berhasil dihapus.');
    }
}
