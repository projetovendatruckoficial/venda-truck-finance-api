<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function index()
    {
        return response()->json(Consultation::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'document' => 'required|string|max:18',
            'consultation_details' => 'nullable|array',
        ]);

        $consultation = Consultation::create($validated);

        return response()->json($consultation, 201);
    }

    public function show(Consultation $consultation)
    {
        return response()->json($consultation);
    }

    public function update(Request $request, Consultation $consultation)
    {
        $validated = $request->validate([
            'document' => 'sometimes|required|string|max:18',
            'consultation_details' => 'sometimes|nullable|array',
        ]);

        $consultation->update($validated);

        return response()->json($consultation);
    }

    public function destroy(Consultation $consultation)
    {
        $consultation->delete();

        return response()->json(['message' => 'Consultation deleted successfully.']);
    }
}
