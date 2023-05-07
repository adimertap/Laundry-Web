<?php

namespace App\Models\Laundry;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksiLaundry extends Model
{
    protected $table = "l_trn_detail_laundry";

    protected $primaryKey = 'id_detail_transaksi';

    protected $fillable = [
        'id_transaksi',
        'id_type',
        'harga_kg',
        'total',
        'berat',
    ];

    protected $hidden =[ 
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;

    public function Transaksi()
    {
        return $this->belongsTo(TransaksiLaundry::class, 'id_transaksi','id_transaksi')->withTrashed();
    }

    public function Type()
    {
        return $this->belongsTo(MasterType::class, 'id_type','id_type')->withTrashed();
    }
}
