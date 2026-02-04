<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Services\ApiBrasilService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CnpjConsultationController extends Controller
{
    protected ApiBrasilService $apiBrasilService;

    public function __construct(ApiBrasilService $apiBrasilService)
    {
        $this->apiBrasilService = $apiBrasilService;
    }

    /**
     * Consulta créditos de CNPJ na ApiBrasil.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function checkCredits(Request $request): JsonResponse
    {
        $request->validate([
            'cnpj' => 'required|string',
            'tipo' => 'nullable|string',
            'homolog' => 'nullable|boolean',
        ]);

        $cnpj = $request->input('cnpj');
        $tipo = $request->input('tipo', 'serasa-real-time');
        $homolog = $request->input('homolog', config('services.apibrasil.homolog'));

        $result = $this->apiBrasilService->checkCnpjCredits($cnpj, $tipo, $homolog);

        if (!$result['success']) {
            return response()->json($result, $result['status'] ?? 500);
        }

        return response()->json($result['data']);
    }
}
