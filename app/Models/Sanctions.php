<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sanctions extends Model
{
    use HasFactory;

    protected $table ='sanctions';
    protected $fillable = [
        'reason',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function sessions()
    {
        return $this->belongsTo(Session::class, 'sessions_id', 'id');
    }
}
