<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Merek;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Barang::with(['merek', 'type'])->get();

        // dd($data);

        return view('admin.barang.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['mereks'] = Merek::all();
        // dd($data);
        return view('admin.barang.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'id_merek' => 'required|numeric|exists:mereks,id',
            'id_type' => 'required|numeric|exists:types,id',
            'stok' => 'required|numeric|min:1',
            'foto' => 'file|mimes:jpeg,png,jpg,gif|max:2048',


        ]);
        // dd($request);
        $random = strtoupper(Str::random($length = 7));
        $nama_image = $random . '_.' . $request->file('foto')->getClientOriginalExtension();
        $request->file('foto')->move('images_uploads', $nama_image);


        $validatedData['foto'] = $nama_image;


        Barang::create($validatedData);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
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
        $data['data'] = Barang::findOrFail($id);
        $data['mereks'] = Merek::all();
        return view('admin.barang.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        // dd($request);

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'id_merek' => 'required|numeric|exists:mereks,id',
            'id_type' => 'required|numeric|exists:types,id',
            'stok' => 'required|numeric|min:1',



        ]);


        $data = Barang::findOrFail($id);

        // Menangani upload foto jika ada
        if ($request->hasFile('foto')) {
            if ($data->foto && file_exists(public_path('images_uploads/' . $data->foto))) {
                unlink(public_path('images_uploads/' . $data->foto)); // Menghapus foto lama
            }
            $random = strtoupper(Str::random($length = 7));
            $nama_image = $random . '_.' . $request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->move('images_uploads', $nama_image);

            // Menambahkan path foto ke dalam validated data
            $validatedData['foto'] = $nama_image;
        }

        // dd($request);


        $data->update($validatedData);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $data = Barang::findOrFail($id);
        $data->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }

    public function getType($id)
    {
        $data = Merek::with('type')->find($id);
        // dd($data);

        $types = [];
        if ($data->type->isNotEmpty()) {
            foreach ($data->type as $type) {
                $types[] = [
                    'nama' => $type->nama,
                    'id' => $type->id
                ];
            }
        }
        return response()->json([
            'types' => $types
        ]);
    }
}
