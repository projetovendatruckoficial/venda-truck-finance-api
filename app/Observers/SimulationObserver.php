<?php

namespace App\Observers;

use App\Models\Simulation;
use App\Services\WebhookService;

class SimulationObserver
{
    /**
     * Handle the Simulation "created" event.
     */
    public function created(Simulation $simulation): void
    {
        WebhookService::send('simulation.created', $simulation->load([
            'user',
            'customer',
            'company',
            'simulationType',
            'simulationStatus',
            'vehicleType',
        ])->toArray());
    }

    /**
     * Handle the Simulation "updated" event.
     */
    public function updated(Simulation $simulation): void
    {
        WebhookService::send('simulation.updated', $simulation->load([
            'user',
            'customer',
            'company',
            'simulationType',
            'simulationStatus',
            'vehicleType',
        ])->toArray());
    }
}
