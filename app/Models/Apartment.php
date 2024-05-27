<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apartment extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name','room_number','bed_number','bathroom_number','square_meters','address','latitude','longitude','visible'];

    //chance to read the connected tables:
    
    //connection one-to many :

    //with users

    public function user() {
        return $this->belongsTo(User::class);
    }

    //with messages
    public function message() {

        // add connection one to many to the apartments

        return $this->hasMany(Message::class);
    }

    //with views
    public function view() {

        // add connection one to many to the apartments

        return $this->hasMany(View::class);
    }


    public function services() {
        return $this->belongsToMany(Service::class);
    }

    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    public function sponsorships() {
        return $this->belongsToMany(Sponsorship::class, 'apartment_sponsorship')
                    ->withPivot('start_date', 'end_date', 'apartment_id', 'sponsorship_id');
    }
}
