<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:adminAccess');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::all();

        return view('admin.user.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Role::all();
        return view('admin.user.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users,email',
            'password' => 'required|string|max:100',
        ]);

        $validatedData['password'] = Hash::make($request->password);

        // jika nilai role kosong
        if (empty($request->role)) return redirect()->route('user.index')->with('error', 'pilih level terlebih dahulu');

        User::create($validatedData)->assignRole($request->role);

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan.');
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
        $item['data'] = User::findOrFail($id);
        $item['roles'] = Role::all();
        return view('admin.user.edit', $item);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        // dd($request);

        $data = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', Rule::unique('users')->ignore($id)],

        ]);

        if (!empty($request->password)) $validatedData['password'] = Hash::make($request->password);


        // jika nilai role kosong
        if (empty($request->role)) return redirect()->route('user.index')->with('error', 'pilih level terlebih dahulu');


        $role = Role::where('name', $request->role)->first();

        $data->update($validatedData);

        $data->syncRoles([$role]);

        return redirect()->route('user.index')->with('success', 'User berhasil edit.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $data = User::findOrFail($id);
        $data->delete();
        return redirect()->route('type.index')->with('success', 'User berhasil dihapus.');
    }
}
