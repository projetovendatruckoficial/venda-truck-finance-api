<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Simulation extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'customer_id',
        'company_id',
        'simulation_type_id',
        'simulation_status_id',
        'score',
        'license_plate',
        'vehicle_type_id',
        'brand',
        'year',
        'version',
        'state',
        'vehicle_value',
        'down_payment',
        'truck_in_name',
        'p24',
        'p48',
        'p60',
        'installments_count',
        'installment_value',
        'initial_cpf',
        'opt_in',
    ];

    protected $casts = [
        'vehicle_value' => 'decimal:2',
        'down_payment' => 'decimal:2',
        'p24' => 'decimal:2',
        'p48' => 'decimal:2',
        'p60' => 'decimal:2',
        'installment_value' => 'decimal:2',
        'truck_in_name' => 'boolean',
        'opt_in' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function simulationType()
    {
        return $this->belongsTo(SimulationType::class);
    }

    public function simulationStatus()
    {
        return $this->belongsTo(SimulationStatus::class);
    }

    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class);
    }
}
