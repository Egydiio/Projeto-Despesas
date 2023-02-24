<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Despesas extends Model
{
    use HasFactory;

    protected $fillable =[
        'descricao',
        'data',
        'usuario',
        'valor'
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'user');
    }
}
