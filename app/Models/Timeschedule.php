<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timeschedule extends Model
{
    use HasFactory;
	protected $table = 'timeschedules';
	protected $fillable = [
        'guideperson_id',
         'start',
         'finish',
    ];
}
