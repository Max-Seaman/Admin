<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    
    protected $fillable = [
        'company_id',
        'first_name',
        'last_name',
        'email',
        'phone',
    ];

    public function getLogoUrlAttribute()
    {
        // If logo is stored in database (either in storage or public path)
        if ($this->logo) {
            return asset($this->logo);
        }

        // Otherwise, return default logo from public/img/
        return asset('img/default-employee.png');
    }
}
