<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Simulation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SimulationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->company_id) {
            $simulations = Simulation::with(['user', 'customer', 'company', 'simulationType', 'simulationStatus', 'vehicleType'])->where('company_id', $user->company_id)->get();
        }

        if ($user->role === 'admin') {
            $simulations = Simulation::with(['user', 'customer', 'company', 'simulationType', 'simulationStatus', 'vehicleType'])->get();
        }

        return response()->json($simulations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'opt_in' => 'sometimes|boolean',
            'user_id' => 'required|exists:users,id',
            'customer_id' => 'nullable|exists:customers,id',
            'company_id' => 'nullable|exists:companies,id',
            'simulation_type_id' => 'required|exists:simulation_types,id',
            'simulation_status_id' => 'required|exists:simulation_statuses,id',
            'score' => 'nullable|integer',
            'license_plate' => 'required|string|max:8',
            'vehicle_type_id' => 'required|exists:vehicle_types,id',
            'brand' => 'required|string|max:255',
            'year' => 'required|integer',
            'version' => 'required|string|max:255',
            'state' => 'required|string|max:2',
            'vehicle_value' => 'required|numeric',
            'down_payment' => 'required|numeric',
            'truck_in_name' => 'nullable|boolean',
            'p24' => 'required|numeric',
            'p48' => 'required|numeric',
            'p60' => 'required|numeric',
            'installments_count' => 'nullable|integer',
            'installment_value' => 'nullable|numeric',
            'initial_document' => 'nullable|string|max:14',
            'simulation_details' => 'nullable|string',
        ]);

        $simulation = Simulation::create($validated);

        return response()->json($simulation, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Simulation $simulation)
    {
        $simulation->load(['user', 'customer', 'simulationType', 'simulationStatus', 'vehicleType']);
        return response()->json($simulation);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Simulation $simulation)
    {
        $validated = $request->validate([
            'opt_in' => 'sometimes|boolean',
            'user_id' => 'sometimes|required|exists:users,id',
            'customer_id' => 'sometimes|nullable|exists:customers,id',
            'company_id' => 'sometimes|nullable|exists:companies,id',
            'simulation_type_id' => 'sometimes|required|exists:simulation_types,id',
            'simulation_status_id' => 'sometimes|required|exists:simulation_statuses,id',
            'score' => 'sometimes|nullable|integer',
            'license_plate' => 'sometimes|required|string|max:8',
            'vehicle_type_id' => 'sometimes|required|exists:vehicle_types,id',
            'brand' => 'sometimes|required|string|max:255',
            'year' => 'sometimes|required|integer',
            'version' => 'sometimes|required|string|max:255',
            'state' => 'sometimes|required|string|max:2',
            'vehicle_value' => 'sometimes|required|numeric',
            'down_payment' => 'sometimes|required|numeric',
            'truck_in_name' => 'sometimes|nullable|boolean',
            'p24' => 'sometimes|required|numeric',
            'p48' => 'sometimes|required|numeric',
            'p60' => 'sometimes|required|numeric',
            'installments_count' => 'sometimes|nullable|integer',
            'installment_value' => 'sometimes|nullable|numeric',
            'initial_document' => 'sometimes|nullable|string|max:14',
            'simulation_details' => 'sometimes|nullable|string',
        ]);

        $simulation->update($validated);

        return response()->json($simulation);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Simulation $simulation)
    {
        $simulation->delete();

        return response()->json(['message' => 'Simulation deleted successfully.']);
    }
}
