<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;
    protected $fillable = ['name','image','room_number','bed_number','bathroom_number','square_meters','address','latitude','longitude'];

    //chance to read the connected tables:
    public function view() {
        //
        return $this->belongsTo(View::class);
    }
}
