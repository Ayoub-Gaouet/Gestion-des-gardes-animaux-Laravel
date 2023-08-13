<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $fillable = [
        'name',
        'age',
        'type',
        'needs',
        'petowner_id'
    ];

    public function petowner()
    {
        return $this->belongsTo(PetOwner::class,"petowner_id");
    }
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

}
