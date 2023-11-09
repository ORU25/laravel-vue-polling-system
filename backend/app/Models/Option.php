<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    protected $fillable = [
        'poll_id',
        'option'
    ];

    public function poll(){
        return $this->belongsTo('App\Models\Poll');
    }

    public function vote(){
        return $this->hasMany('App\Models\Vote');
    }
}
