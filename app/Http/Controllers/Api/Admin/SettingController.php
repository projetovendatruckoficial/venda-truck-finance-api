<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display the settings.
     */
    public function index()
    {
        $setting = Setting::first();
        return response()->json($setting);
    }

    /**
     * Store or Update the settings (Singleton pattern).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'data' => 'required|array',
        ]);

        $setting = Setting::first();

        if ($setting) {
            $mergedData = array_merge($setting->data ?? [], $validated['data']);
            $validated['data'] = $this->formatData($mergedData);
            
            $setting->update($validated);
            return response()->json($setting, 200);
        }

        $validated['data'] = $this->formatData($validated['data']);
        $setting = Setting::create($validated);
        
        return response()->json($setting, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        return response()->json($setting);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        $validated = $request->validate([
            'data' => 'sometimes|required|array',
        ]);

        if (isset($validated['data'])) {
            $mergedData = array_merge($setting->data ?? [], $validated['data']);
            $validated['data'] = $this->formatData($mergedData);
        }

        $setting->update($validated);

        return response()->json($setting);
    }

    /**
     * Format specific fields in the data array.
     */
    private function formatData(array $data): array
    {
        if (isset($data['taxa_padrao'])) {
            $data['taxa_padrao'] = number_format((float) $data['taxa_padrao'], 2, '.', '');
        }

        return $data;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        $setting->delete();

        return response()->json(['message' => 'Setting deleted successfully.']);
    }
}
