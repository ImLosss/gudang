<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Merek extends Model
{
    protected $guarded = ['id'];

    public function type()
    {
        return $this->hasMany(Type::class, 'id_merek', 'id');
    }
}
