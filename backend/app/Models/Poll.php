<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'question'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function option(){
        return $this->hasMany('App\Models\Option');
    }

    public function vote(){
        return $this->hasMany('App\Models\Vote');
    }
}
