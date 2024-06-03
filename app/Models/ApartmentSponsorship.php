<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApartmentSponsorship extends Model
{
    use HasFactory;

    protected $table = 'apartment_sponsorship';

    protected $fillable = ['apartment_id','sponsorship_id','start_date','end_date'];

    // protected $casts = ['start_date' => 'datetime:Y-m-d',];
    public function apartments()
    {
        return $this->belongsTo(Apartment::class);
    }

    public function sponsorships()
    {
        return $this->belongsTo(Sponsorship::class);
    }

}

