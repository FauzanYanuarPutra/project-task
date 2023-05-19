<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pembeli extends Model
{
    use HasFactory, SoftDeletes;

    // protected $keyType = 'string';
    // protected $primaryKey = 'id_pembeli';
    // public $incrementing = false;

    protected $dates = ['deleted_at'];


    protected $fillable = [
        'nama_pembeli',
        'alamat_pembeli',
        'jenis_kelamin_pembeli',
        'telp_pembeli'
    ];
}
