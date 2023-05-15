<?php

namespace App\Models\Laundry;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class TransaksiLaundry extends Model
{
    use SoftDeletes;

    protected $table = "l_trn_laundry";

    protected $primaryKey = 'id_transaksi';

    protected $fillable = [
        'nomor_transaksi',
        'tanggal_transaksi',
        'nama_customer',
        'id_category_penerima',
        'alamat',
        'nomor_telephone',
        'total',
        'total_berat',
        'id_pegawai',
        'status',
        'tanggal_ambil',
        'status_paid'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public $timestamps = true;

    public function Pegawai()
    {
        return $this->belongsTo(User::class, 'id_pegawai', 'id')->withTrashed();
    }

    public function Jenis()
    {
        return $this->belongsTo(MasterCategoryPenerima::class, 'id_category_penerima', 'id_category_penerima');
    }

    public function Detail()
    {
        return $this->hasMany(DetailTransaksiLaundry::class, 'id_transaksi','id_transaksi');
    }

    public static function getId()
    {
        $getId = DB::table('l_trn_laundry')->orderBy('id_transaksi', 'DESC')->take(1)->get();
        if (count($getId) > 0) return $getId;
        return (object)[
            (object)[
                'id_transaksi' => 0
            ]
        ];
    }
}
