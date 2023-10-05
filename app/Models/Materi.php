<?php

namespace App\Models;

use App\Models\IsiMateri;
use App\Models\Pelatihan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Materi extends Model
{
    use HasFactory;

    protected $fillable = [
      'pelatihan_id',

    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function pelatihan()
    {
        return $this->belongsTo(Pelatihan::class);
    }

    public function isimateris()
    {
        return $this->hasMany(IsiMateri::class);
    }
}
