<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'document',
        'phone',
        'address',
        'city',
        'state',
        'zip',
        'country',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function simulations()
    {
        return $this->hasMany(Simulation::class);
    }
}
