<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'full_name',
        'company',
        'phone_number',
        'email',
        'birthday',
        'photo'
    ];
}
