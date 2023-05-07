<?php

namespace App\Models\Laundry;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterCategoryPenerima extends Model
{
    protected $table = "l_mst_category_penerima";

    protected $primaryKey = 'id_category_penerima';

    protected $fillable = [
        'nama_kategori_penerima',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;
}
