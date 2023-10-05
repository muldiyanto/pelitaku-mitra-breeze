<?php

namespace App\Models;

use App\Models\Kategori;
use App\Models\PemilikProgram;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pelatihan extends Model
{
    use HasFactory;

    protected $fillable = [
     'name','pemilikprogram_id','kategori_id','slug','hari',
     'jamlat','tgl_mulai','tgl_akhir','jml_peserta','keterangan'
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function pemilikprogram(): BelongsTo
    {
        return $this->belongsTo(PemilikProgram::class);
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }
}
