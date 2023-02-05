<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guideperson extends Model
{
    use HasFactory;
	protected $table = 'guidepersons';
	protected $fillable = [
        'user_id',
         'certificatename',
         'orginalcertificatename',
    ];
}
