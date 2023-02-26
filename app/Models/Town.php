<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    use HasFactory;
	protected $table = 'towns';
	protected $fillable = [
        'name',
        'province_id',
        'description',
        'photoname',
        'orginalphotoname'
    ];
}
