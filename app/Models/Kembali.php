<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kembali extends Model
{
    protected $table = 'kembali';
    protected $guarded = [];
    protected $casts = [
        'tanggal_kembali' => 'datetime',
    ];

    public function pinjam()
    {
        return $this->belongsTo(Pinjam::class);
    }
}
