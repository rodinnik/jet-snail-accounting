<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'status',
        'firm',
        'model'
    ];
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}