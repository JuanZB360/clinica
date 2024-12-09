<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Speciality extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $auditInclude = [
        'name',
    ];

    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
