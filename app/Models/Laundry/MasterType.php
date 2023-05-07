<?php

namespace App\Models\Laundry;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterType extends Model
{
    use SoftDeletes;

    protected $table = "l_mst_type_laundry";

    protected $primaryKey = 'id_type';

    protected $fillable = [
        'nama_type',
        'price',
        'keterangan',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public $timestamps = true;
}
