<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;



class Barang extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'barangs';


    // protected $keyType = 'string';
    // protected $primaryKey = 'id_baransg';
    // public $incrementing = false;

    protected $dates = ['deleted_at'];

    // public $timestamps = true;

    // const CREATED_AT = 'tgl_dibuat_barang';
    // const UPDATED_AT = 'tgl_diubah_barang';
    // const DELETED_AT = 'tgl_dihapus_barang';



    
    


    protected $fillable = [
        'nama_barang',
        'harga_barang',
        'stok_barang',
        'id_supplier'
    ];

    public function allData()
    {
        
        return DB::table('barangs')
                ->join('suppliers', 'suppliers.id', '=', 'barangs.id_supplier')
                ->select(
                    'barangs.id AS id', 
                    'suppliers.id AS id_supplier',
                    'barangs.nama_barang',
                    'barangs.stok_barang',
                    'barangs.harga_barang',
                    'suppliers.nama_supplier',
                    'suppliers.alamat_supplier',
                    'suppliers.telp_supplier',
                    'barangs.created_at',
                    'barangs.updated_at',
                    'barangs.deleted_at',


                    )
                ->get();

        
    }
}
