<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'name',
        'services',
        'cost',
        'confirmation_status',
        'cancellation_status',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,"user_id");
    }
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
