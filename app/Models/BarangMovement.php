<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Barang;

class BarangMovement extends Model
{
    use HasFactory;

    protected $fillable = [
        'barang_id',
        'type',
        'quantity',
        'source',
        'reason',
        'date',
        'notes',
        'user_id',
    ];

    protected $casts = [
        'date' => 'date',
    ];


    public function barang()
    {
        return $this->belongsTo(Barangs::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
