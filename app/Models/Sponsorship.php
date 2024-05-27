<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    use HasFactory;

    protected $fillable = ['title','price','description'];

    public function apartments() {
        return $this->belongsToMany(Apartment::class, 'apartment_sponsorship')
                    ->withPivot('start_date', 'end_date', 'apartment_id', 'sponsorship_id');
    }
}
