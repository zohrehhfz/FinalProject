<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $table = 'provinces';
	protected $fillable = [
        'name',
        'description',
        'photoname',
        'orginalphotoname'
    ];

    public function towns()
	{
		return $this->hasMany('App\Models\Town');
	}
    public function comments()
	{
		return $this->hasMany('App\Models\Provincecomment');
	}

}
