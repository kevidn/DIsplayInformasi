<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    use HasFactory;

    protected $table = 'tema'; // Sesuaikan dengan nama tabel di database jika berbeda

    protected $fillable = [
        'bg', 'color',
    ];
}
