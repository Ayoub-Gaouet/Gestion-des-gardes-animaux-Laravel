<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Adresse extends Model
{
    protected $fillable = [
        'rue',
        'ville',
        'code_postal',
        'petsitter_id'
    ];
    public function petsitter()
    {
        return $this->belongsTo(PetSitter::class,"petsitter_id");
    }
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
