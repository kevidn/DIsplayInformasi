<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    use HasFactory;

        /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'logo1',
        'logo2',
    ];

    /**
     * logo
     *
     * @return Attribute
     */
    protected function image(): Attribute
    {
        return Attribute::make(
            get: function ($logo1, $logo2) {
            return [
                url('/storage/header/upload/' . $logo1),
                url('/storage/header/upload/' . $logo2),
            ];  
        },
    );
    }
}
