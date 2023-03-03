<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincecomment extends Model
{
    use HasFactory;
    protected $table = 'provincecomments';
	protected $fillable = [
        'user_id',
        'province_id',
        'message'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
