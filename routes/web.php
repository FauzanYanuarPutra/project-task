<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\PembeliController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SupplierController;

use App\Models\Barang;
use App\Models\Supplier;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
        $barangs = Barang::all();
        $barangsCount = $barangs->count();

        $suppliers = Supplier::all();
        $suppliersCount = $suppliers->count();

        return Inertia::render('Dashboard', [
            'barangsCount' => $barangsCount,
            'suppliersCount' => $suppliersCount,
        ]);
    // return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Barang
    Route::resource('barangs',BarangController::class);
    Route::get('/barangs-restore', [BarangController::class, 'indexRestore'])->name('barangs.indexrestore');
    Route::put('/barangs-restore-all', [BarangController::class, 'restoreAll'])->name('barangs.restoreall');
    Route::put('/barangs/{id}/restore', [BarangController::class, 'restore'])->name('barangs.restore');
    Route::delete('/barangs/{id}/destroypermanent', [BarangController::class, 'destroyPermanent'])->name('barangs.destroypermanent');
    // End Barang

    // Supplier
    Route::resource('suppliers',SupplierController::class);
    Route::get('/suppliers-restore', [SupplierController::class, 'indexRestore'])->name('suppliers.indexrestore');
    Route::put('/suppliers-restore-all', [SupplierController::class, 'restoreAll'])->name('suppliers.restoreall');
    Route::put('/suppliers/{id}/restore', [SupplierController::class, 'restore'])->name('suppliers.restore');
    Route::delete('/suppliers/{id}/destroypermanent', [SupplierController::class, 'destroyPermanent'])->name('suppliers.destroypermanent');

    // End Supplier


    Route::resource('pembelis',PembeliController::class);
    Route::get('/pembelis-restore', [PembeliController::class, 'indexRestore'])->name('pembelis.indexrestore');
    Route::put('/pembelis/{id}/restore', [PembeliController::class, 'restore'])->name('pembelis.restore');

    
});

require __DIR__.'/auth.php';
