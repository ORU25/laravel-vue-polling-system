<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;
    protected $fillable = [
        'poll_id',
        'option_id',
    ];

    public function poll(){
        return $this->belongsTo('App\Models\Poll');
    }

    public function option(){
        return $this->belongsTo('App\Models\Option');
    }
    public function user(){
        return $this->belongsTo('App\Models\Users');
    }
}
