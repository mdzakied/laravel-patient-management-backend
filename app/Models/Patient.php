<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{

    // Use the HasFactory trait.
    use HasFactory;

    // Define the attributes that are mass assignable.
    protected $fillable = [
        "user_id",
        'name',
        'date_of_birth',
        'gender',
        'phone_number',
        'email',
        'address',
        'emergency_contact_name',
        'emergency_contact_phone',
    ];

    // Define the attributes that should be cast to native types.
    protected $casts = [
        'date_of_birth' => 'date',
    ];

    // Define the attributes that should be hidden for serialization.
    protected $hidden = ['user_id']; 

    // Relations to table Users
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
