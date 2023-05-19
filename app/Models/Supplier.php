<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Supplier extends Model
{
    use HasFactory, SoftDeletes;

    // protected $keyType = 'string';
    // protected $primaryKey = 'id_supplier';
    // public $incrementing = false;

    protected $dates = ['deleted_at'];

    // public $timestamps = true;

    // const CREATED_AT = 'tgl_dibuat_supplier';
    // const UPDATED_AT = 'tgl_diubah_supplier';
    // const DELETED_AT = 'tgl_dihapus_supplier';


    protected $fillable = [
        'nama_supplier',
        'alamat_supplier',
        'telp_supplier'
    ];

}
