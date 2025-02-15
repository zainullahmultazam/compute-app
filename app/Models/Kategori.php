<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    use HasFactory;
    
    protected $table = 'kategoris';

    protected $fillable = ['nama', 'keterangan', 'status'];

    protected $primaryKey = 'id_kategori';

    /**
     * Get all of the buku for the kategori
     * Return \Illuminte\Database\Eloquent\Relations\Hashmany
     */
    public function buku(): HasMany
    {
        return $this->hasMany(Buku::class, 'kategori_id', 'id_kategori');
    }
}


