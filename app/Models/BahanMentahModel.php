<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BahanMentahModel extends Model
{
    use HasFactory;
    protected $table = 'bahan_mentah';
    protected $fillable = ['jenis', 'berat','bambu', 'harga'];
}
