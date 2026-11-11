<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananMaintenance extends Model
{
    use HasFactory;

    protected $table = 'layanan_maintenances';
    protected $fillable = ['nama_bengkel', 'jenis_layanan', 'catatan'];
}