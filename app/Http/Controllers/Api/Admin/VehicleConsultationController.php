<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Services\ApiBrasilService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class VehicleConsultationController extends Controller
{
    protected ApiBrasilService $apiBrasilService;

    public function __construct(ApiBrasilService $apiBrasilService)
    {
        $this->apiBrasilService = $apiBrasilService;
    }

    /**
     * Consulta créditos de veículos na ApiBrasil.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function checkCredits(Request $request): JsonResponse
    {
        $request->validate([
            'placa' => 'required|string',
            'tipo' => 'nullable|string',
            'homolog' => 'nullable|boolean',
        ]);

        $placa = $request->input('placa');
        $tipo = $request->input('tipo', 'fipe-chassi');
        $homolog = $request->input('homolog', config('services.apibrasil.homolog'));

        $result = $this->apiBrasilService->checkVehicleCredits($placa, $tipo, $homolog);

        if (!$result['success']) {
            return response()->json($result, $result['status'] ?? 500);
        }

        return response()->json($result['data']);
    }
}
