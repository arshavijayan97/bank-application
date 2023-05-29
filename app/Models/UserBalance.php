<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBalance extends Model
{
    protected $fillable = ['user_id', 'amount', 'type', 'balance', 'date','from_id','tranfer_type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
