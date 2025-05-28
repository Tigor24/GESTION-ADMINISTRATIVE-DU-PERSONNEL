<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conge extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'type', 'date_debut', 'date_fin', 'motif', 'statut'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


