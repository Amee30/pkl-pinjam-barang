<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Borrowing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'barang_id',
        'borrowed_at',
        'return_due_date',
        'status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function barang()
    {
        return $this->belongsTo(Barangs::class);
    }
}
