<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount', 'description', 'created_at'
    ];

    protected $visible = [
        'amount', 'description', 'created_at'
    ];
}
