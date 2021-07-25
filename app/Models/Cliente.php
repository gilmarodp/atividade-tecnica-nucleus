<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'clientes';

    public $timestamps = true;

    public function endereco()
    {
        return $this->hasOne(Endereco::class, 'cliente_id', 'id');
    }
}
