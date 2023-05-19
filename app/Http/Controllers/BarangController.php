<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Supplier;

use Illuminate\Http\Request;
use Inertia\Inertia;


class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->Barang = new Barang;
    }

    public function index()
    {
        // $barangs = Barang::all();
        // $suppliers = Supplier::all();


        return Inertia::render('Barang/Index', [
            'barangs' => $this->Barang->allData()->whereNull('barangs.deleted_at')->paginate(10),
            'status' => 'restore'
            // 'suppliers' => $suppliers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();

        return Inertia::render('Barang/Create', [
            'suppliers' => $suppliers->map(function ($supplier) {
                return [
                    'id' => $supplier->id,
                    'nama_supplier' => $supplier->nama_supplier,
                ];
            })
        ]);;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:64',
            'harga_barang' => 'required|string|max:64',
            'stok_barang' => 'required|string|max:64',
            'id_supplier' => 'required|string|max:255',
        ]);
        Barang::create([
            'nama_barang' => $request->nama_barang,
            'harga_barang' => $request->harga_barang,
            'stok_barang' => $request->stok_barang,
            'id_supplier' => $request->id_supplier,

        ]);
        sleep(1);

        return redirect()->route('barangs.index')->with('message', 'Supplier Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        $suppliers = Supplier::all();

        return Inertia::render(
            'Barang/Edit',
            [
                'barang' => $barang,
                'suppliers' => $suppliers->map(function ($supplier) {
                    return [
                        'id' => $supplier->id,
                        'nama_supplier' => $supplier->nama_supplier,
                    ];
                })
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        $data = $request->validate([
            'nama_barang' => 'required|string|max:64',
            'harga_barang' => 'required|string|max:64',
            'stok_barang' => 'required|string|max:64',
            'id_supplier' => 'required|string|max:255',
        ]);
        $barang->update($data);

        return redirect()->route('barangs.index')->with('success', 'Barang updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $barangs = Barang::findOrFail($id);
        $barangs->delete();
        // sleep(1);

        return redirect()->route('barangs.index')->with('message', 'Barang Delete Successfully');
    }

    public function destroyPermanent($id)
    {

        Barang::where('id', $id)->withTrashed()->forceDelete();
        
        // sleep(1);

        // return redirect()->route('users.index', ['status' => 'archived'])
            // ->withSuccess(__('User force deleted successfully.'));

        return redirect()->route('barangs.indexrestore')->with('message', 'barang Delete Successfully');
    }


    public function indexRestore()
    {
        return Inertia::render('Barang/Index', [
            'barangs' => $this->Barang->allData()->whereNot('barangs.deleted_at')->paginate(10),
            'status' => 'back'
        ]);

    }

    public function restore($id)
    {
        Barang::where('id', $id)->withTrashed()->restore();

        return redirect()->route('barangs.indexrestore')->with('message', 'barang Delete Successfully');

    }

    public function restoreAll() 
    {
        Barang::onlyTrashed()->restore();

        return redirect()->route('barangs.indexrestore')->withSuccess(__('All barangs restored successfully.'));
    }
}
