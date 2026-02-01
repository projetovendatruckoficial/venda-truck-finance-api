<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'document',
        'document_rg',
        'birth_date',
        'mother_name',
        'marital_status',
        'phone',
        'email',
        'profession',
        'service_time',
        'income',
        'address',
        'zip_code',
        'number',
        'district',
        'city',
        'state',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'income' => 'decimal:2',
    ];

    public function simulations()
    {
        return $this->hasMany(Simulation::class, 'customer_id');
    }
}
