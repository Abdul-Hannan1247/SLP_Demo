<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'date',
        'time',
        'appointment_notes',
        // '_token', // Add _token here
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
