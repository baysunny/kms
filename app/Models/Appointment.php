<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'schedule',
        'status',
        'note'
    ];

    public function scopeFilter($query, array $filters){
        if (isset($filters['start']) && isset($filters['end'])) {
            $query->whereBetween('schedule', [$filters['start'], $filters['end']]);
        }
    }

    public function patient(){
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
