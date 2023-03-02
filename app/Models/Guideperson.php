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
    public function user()
	{
		return $this->belongsTo('App\Models\User');
	}

    public function followers()
	{
		return $this->belongsToMany('App\Models\User');
	}
}
