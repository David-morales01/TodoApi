<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];
    use HasFactory;
    
    protected $casts = [
        'completed_at' => 'datetime:Y-m-d / H:i',
        'created_at' => 'datetime:Y-m-d / H:i',
    ];
}
