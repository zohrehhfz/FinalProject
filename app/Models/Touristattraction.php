<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Touristattraction extends Model
{
    use HasFactory;
    protected $table = 'touristattractions';
	protected $fillable = [
        'name',
        'town_id',
        'photoname',
        'orginalphotoname',
        'description'
    ];
}
