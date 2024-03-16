<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTbl extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function konsumen()
    {
        return $this->belongsTo(KonsumenTbl::class, 'id_konsumens');
    }
    public function layanan()
    {
        return $this->belongsTo(LayananTbl::class, 'id_layanans');
    }
    public function pembayaran()
    {
        return $this->hasOne(PembayaranTbl::class, 'id_orders');
    }


}
