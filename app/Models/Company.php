<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public function employees() 
    {
        return $this->hasMany(Employee::class);
    }

    protected $fillable = [
        'name',
        'email',
        'logo',
        'website',
    ];

    public function getLogoUrlAttribute()
    {
        // If logo is stored in database (either in storage or public path)
        if ($this->logo) {
            return asset($this->logo);
        }

        // Otherwise, return default logo from public/img/
        return asset('img/default-company.png');
    }

}
