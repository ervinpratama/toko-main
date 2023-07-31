<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengrajinModel extends Model
{
    use HasFactory;
    protected $table = 'pengrajin';
    protected $fillable = ['nama', 'kerajinan', 'total'];
}
