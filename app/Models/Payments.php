<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;

    protected $table ='payments';
    protected $fillable = [
        'user_id',
        'session_id',
        'amount',
        'created_at',
    ];

         
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function sessions()
    {
        return $this->belongsTo(Session::class, 'session_id', 'id');
    }

}
