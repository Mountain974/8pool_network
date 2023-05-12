<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    
    // nom au pluriel car un message peut regrouper plusieurs commentaires
    // cardinalité 1,n
    public function users(){
        return $this->hasMany(User::class);
    }
  
}
