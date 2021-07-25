<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    public $timestamps = true;

    public function cliente()
    {
        return $this->hasOne(Cliente::class, 'id', 'cliente_id');
    }
}
