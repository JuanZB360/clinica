<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class MedicalHistory extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $auditInclude = [
        'appointment_id',
        'content',
    ];

    protected $fillable = [
        'appointment_id',
        'content',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
