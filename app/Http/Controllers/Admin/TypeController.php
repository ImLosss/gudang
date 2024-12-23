<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Merek;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Type::with('merek')->get();
        // dd($data);
        return view('admin.type.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $data['mereks'] = Merek::all();
        // dd($data);
        return view('admin.type.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_merek' => 'required|numeric|exists:mereks,id',
            'nama' => 'required|string|max:255',
        ]);

        Type::create($validatedData);

        return redirect()->route('type.index')->with('success', 'Type berhasil ditambahkan.');
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
        $data['type'] = Type::findOrFail($id);
        $data['mereks'] = Merek::all();
        // dd($data);
        return view('admin.type.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'id_merek' => 'required|numeric|exists:mereks,id',
            'nama' => 'required|string|max:255',
        ]);

        $data = Type::findOrFail($id);
        $data->update($validatedData);

        return redirect()->route('type.index')->with('success', 'Type berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Type::findOrFail($id);
        $data->delete();
        return redirect()->route('type.index')->with('success', 'Type berhasil dihapus.');
    }
}
