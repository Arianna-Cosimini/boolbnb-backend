<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public function apartments() {
        // add connection one to many to the messages
        return $this->hasMany(Apartment::class);
    }
}
