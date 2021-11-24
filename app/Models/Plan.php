<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'duration',
    ];

    public function getMoneyPriceAttribute()
    {   
        return 'RM '.number_format( ($this->price / 100), 2 );
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::title($value);
    }
    
}
