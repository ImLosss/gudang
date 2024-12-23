<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    //

    protected $guarded = ['id'];



    public function type()
    {
        return $this->belongsTo(Type::class, 'id_type', 'id');
    }

    public function merek()
    {
        return $this->belongsTo(Merek::class, 'id_merek', 'id');
    }
}
