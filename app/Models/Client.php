<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';
    protected $fillable=[
        'user_id','latitude','longitude','typeclient','zone_id'
    ];

    public function user(){
        return $this->belongsTo(User::classe);
    }
  
    public function zone(){
        return $this->belongsTo(Zone::class);
    }
}
