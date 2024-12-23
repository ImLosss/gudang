<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $guarded = ['id'];


    public function merek()
    {
        return $this->belongsTo(Merek::class, 'id_merek', 'id');
    }
}
