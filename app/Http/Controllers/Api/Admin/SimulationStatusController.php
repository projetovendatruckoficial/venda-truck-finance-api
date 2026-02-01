<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\SimulationStatus;
use Illuminate\Http\Request;

class SimulationStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statuses = SimulationStatus::all();
        return response()->json($statuses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'required|string|max:50',
        ]);

        $status = SimulationStatus::create($validated);

        return response()->json($status, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(SimulationStatus $simulationStatus)
    {
        return response()->json($simulationStatus);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SimulationStatus $simulationStatus)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'color' => 'sometimes|required|string|max:50',
        ]);

        $simulationStatus->update($validated);

        return response()->json($simulationStatus);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SimulationStatus $simulationStatus)
    {
        $simulationStatus->delete();

        return response()->json(['message' => 'Simulation status deleted successfully.']);
    }
}
