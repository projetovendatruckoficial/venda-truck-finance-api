<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\SimulationType;
use Illuminate\Http\Request;

class SimulationTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = SimulationType::all();
        return response()->json($types);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $type = SimulationType::create($validated);

        return response()->json($type, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(SimulationType $simulationType)
    {
        return response()->json($simulationType);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SimulationType $simulationType)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
        ]);

        $simulationType->update($validated);

        return response()->json($simulationType);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SimulationType $simulationType)
    {
        $simulationType->delete();

        return response()->json(['message' => 'Simulation type deleted successfully.']);
    }
}
