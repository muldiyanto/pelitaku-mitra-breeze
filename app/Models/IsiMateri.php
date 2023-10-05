<?php

namespace App\Models;

// use App\Models\Team;
// use App\Models\Materi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IsiMateri extends Model
{
    use HasFactory;

    protected $fillable = [
      'materi_id',
      'name',
      'slug',
      'jamlat',
      'bahanajar',
       'video',

    ];

    protected $casts = [
      'bahanajar' => 'array'
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function materi(): BelongsTo
    {
        return $this->belongsTo(Materi::class);
    }

}
