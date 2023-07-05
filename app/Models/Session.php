<?php

namespace App\Models;

use App\Models\Payments;
use App\Models\Sanctions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Session extends Model
{
    use HasFactory;

    protected $table ='sessions';
    protected $fillable = [
        'end_date',
        'amount',
        'start_date',
    ];

    public function payments(){
        return $this->hasMany(Payments::class);
    }

    public function sanctions(){
        return $this->hasMany(Sanctions::class);
    }

}
