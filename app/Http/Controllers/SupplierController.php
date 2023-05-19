<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Inertia\Inertia;


class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::all();


        return Inertia::render('Supplier/Index', [
                'suppliers' => $suppliers,
                'status' => 'restore',
                
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render(
            'Supplier/Create'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_supplier' => 'required|string|max:64',
            'alamat_supplier' => 'required|string|max:64',
            'telp_supplier' => 'required|string|max:64',

        ]);
        Supplier::create([
            'nama_supplier' => $request->nama_supplier,
            'alamat_supplier' => $request->alamat_supplier,
            'telp_supplier' => $request->telp_supplier,
        ]);
        sleep(1);

        return redirect()->route('suppliers.index')->with('message', 'Supplier Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        return Inertia::render('Supplier/Edit', [
            'supplier' => [
                'id' => $supplier->id,
                'nama_supplier' => $supplier->nama_supplier,
                'alamat_supplier' => $supplier->alamat_supplier,
                'telp_supplier' => $supplier->telp_supplier,
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $data = $request->validate([
            'nama_supplier' => 'required|string|max:64',
            'alamat_supplier' => 'required|string|max:64',
            'telp_supplier' => 'required|string|max:64',

        ]);
        $supplier->update($data);

        return redirect()->route('suppliers.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        // sleep(1);

        return redirect()->route('suppliers.index')->with('message', 'supplier Delete Successfully');
    }

    public function destroyPermanent($id)
    {

        Supplier::where('id', $id)->withTrashed()->forceDelete();
        
        // sleep(1);

        // return redirect()->route('users.index', ['status' => 'archived'])
            // ->withSuccess(__('User force deleted successfully.'));

        return redirect()->route('suppliers.indexrestore')->with('message', 'supplier Delete Successfully');
    }


    public function indexRestore()
    {
        $suppliers = Supplier::onlyTrashed()->get();

        return Inertia::render(
            'Supplier/Index',
            [
                'suppliers' => $suppliers,
                'status' => 'back'
            ]
        );

    }

    public function restore($id)
    {
        Supplier::where('id', $id)->withTrashed()->restore();

        return redirect()->route('suppliers.indexrestore')->with('message', 'supplier Delete Successfully');

    }

    public function restoreAll() 
    {
        Supplier::onlyTrashed()->restore();

        return redirect()->route('suppliers.indexrestore')->withSuccess(__('All suppliers restored successfully.'));
    }

}
