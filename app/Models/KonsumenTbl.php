<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonsumenTbl extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function order()
    {
        return $this->hasMany(OrderTbl::class, 'id_konsumen');
    }

}
