<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;

use App\Models\Customer;
use App\Models\Simulation;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        return response()->json($customers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'document' => 'required|string|max:14|unique:customers,document',
            'document_rg' => 'nullable|string|max:20',
            'birth_date' => 'nullable|date',
            'mother_name' => 'nullable|string|max:255',
            'marital_status' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'profession' => 'nullable|string|max:255',
            'service_time' => 'nullable|string|max:255',
            'income' => 'nullable|numeric',
            'address' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:10',
            'number' => 'nullable|string|max:20',
            'district' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:2',
            'simulation_id' => 'nullable|exists:simulations,id',
        ]);

        $customer = Customer::create($validated);

        if ($request->has('simulation_id')) {
            Simulation::where('id', $request->simulation_id)->update(['customer_id' => $customer->id]);
        }

        return response()->json($customer, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return response()->json($customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'document' => 'sometimes|required|string|max:14|unique:customers,document,' . $customer->id,
            'document_rg' => 'nullable|string|max:20',
            'birth_date' => 'nullable|date',
            'mother_name' => 'nullable|string|max:255',
            'marital_status' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'profession' => 'nullable|string|max:255',
            'service_time' => 'nullable|string|max:255',
            'income' => 'nullable|numeric',
            'address' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:10',
            'number' => 'nullable|string|max:20',
            'district' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:2',
            'simulation_id' => 'nullable|exists:simulations,id',
        ]);

        $customer->update($validated);

        if ($request->has('simulation_id')) {
            Simulation::where('id', $request->simulation_id)->update(['customer_id' => $customer->id]);
        }

        return response()->json($customer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return response()->json(['message' => 'Customer deleted successfully.']);
    }
}
