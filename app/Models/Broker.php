<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Broker extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'city',
        'phone_number',
        'zip_code',
        'logo_path',
    ];
}
