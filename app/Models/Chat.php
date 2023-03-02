<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "guideperson_id",
        "flag",
        "message",
    ];
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function guideperson()
    {
        return $this->belongsTo('App\Models\Guideperson');
    }
}
