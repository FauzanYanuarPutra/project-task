<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PembeliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $pembelis = Pembeli::all();
        $pembelis = Pembeli::where('deleted_at')->get();
        
        return Inertia::render(
            'Pembelis/Index',
            [
                'pembelis' => $pembelis,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render(
            'Pembelis/Create'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pembeli' => 'required|string|max:255',
            'alamat_pembeli' => 'required|string|max:255',
            'jenis_kelamin_pembeli' => 'required|string|max:255',
            'telp_pembeli' => 'required|string|max:255',

        ]);
        Pembeli::create([
            'nama_pembeli' => $request->nama_pembeli,
            'alamat_pembeli' => $request->alamat_pembeli,
            'jenis_kelamin_pembeli' => $request->jenis_kelamin_pembeli,
            'telp_pembeli' => $request->telp_pembeli,
        ]);
        sleep(1);

        return redirect()->route('pembelis.index')->with('message', 'Pembeli Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pembeli $pembeli)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembeli $pembeli)
    {
        return Inertia::render(
            'Pembelis/Edit',
            [
                'pembeli' => $pembeli,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembeli $pembeli)
    {
        $request->validate([
            'nama_pembeli' => 'required|string|max:255',
            'alamat_pembeli' => 'required|string|max:255',
            'jenis_kelamin_pembeli' => 'required|string|max:255',
            'telp_pembeli' => 'required|string|max:255',
        ]);

        $pembeli->nama_pembeli = $request->nama_pembeli;
        $pembeli->alamat_pembeli = $request->alamat_pembeli;
        $pembeli->jenis_kelamin_pembeli = $request->jenis_kelamin_pembeli;
        $pembeli->telp_pembeli = $request->telp_pembeli;
        $pembeli->save();
        sleep(1);

        return redirect()->route('pembelis.index')->with('message', 'Pembeli Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $pembeli = Pembeli::findOrFail($id);
        $pembeli->delete();
        // sleep(1);

        return redirect()->route('pembelis.index')->with('message', 'Pembeli Delete Successfully');
    }

    public function indexRestore()
    {
        $pembelis = Pembeli::onlyTrashed()->get();

        return Inertia::render(
            'Pembelis/Index',
            [
                'pembelis' => $pembelis,
                'status' => 'back'
            ]
        );

    }

    public function restore($id)
    {
        $pembeli = Pembeli::onlyTrashed()->findOrFail($id);
        $pembeli->restore();

        return redirect()->route('your-resource.index');
    }

}
