<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ApiBrasilService
{
    protected string $token;
    protected string $baseUrl = 'https://gateway.apibrasil.io/api/v2';

    public function __construct()
    {
        $this->token = config('services.apibrasil.token') ?? env('API_BRASIL_TOKEN');
    }

    /**
     * Consulta créditos de veículos.
     *
     * @param string $placa
     * @param string $tipo
     * @param bool $homolog
     * @return array
     */
    public function checkVehicleCredits(string $placa, string $tipo = 'fipe-chassi', bool $homolog = true): array
    {
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => "Bearer {$this->token}",
                'User-Agent' => 'Laravel/10.0', // Simula um User-Agent compatível
            ])->post("{$this->baseUrl}/consulta/veiculos/credits", [
                        'tipo' => $tipo,
                        'placa' => $placa,
                        'homolog' => $homolog,
                    ]);

            Log::info('ApiBrasil Request', [
                'endpoint' => "{$this->baseUrl}/consulta/veiculos/credits",
                'payload' => compact('tipo', 'placa', 'homolog'),
                'response_status' => $response->status(),
                'response_body' => $response->json(),
            ]);


            if ($response->failed()) {
                Log::error('ApiBrasil Request Failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'placa' => $placa
                ]);

                return [
                    'success' => false,
                    'message' => 'Falha ao consultar ApiBrasil.',
                    'error' => $response->json(),
                    'status' => $response->status()
                ];
            }

            return [
                'success' => true,
                'data' => $response->json()
            ];

        } catch (\Exception $e) {
            Log::error('ApiBrasil Exception', [
                'message' => $e->getMessage(),
                'placa' => $placa
            ]);

            return [
                'success' => false,
                'message' => 'Erro interno ao processar consulta.',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Consulta créditos de CPF.
     *
     * @param string $cpf
     * @param string $tipo
     * @param bool $homolog
     * @return array
     */
    public function checkCpfCredits(string $cpf, string $tipo = 'acerta-essencial', bool $homolog = true): array
    {
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => "Bearer {$this->token}",
                'User-Agent' => 'Laravel/10.0',
            ])->post("{$this->baseUrl}/consulta/cpf/credits", [
                        'tipo' => $tipo,
                        'cpf' => $cpf,
                        'homolog' => $homolog,
                    ]);

            Log::info('ApiBrasil CPF Request', [
                'endpoint' => "{$this->baseUrl}/consulta/cpf/credits",
                'payload' => compact('tipo', 'cpf', 'homolog'),
                'response_status' => $response->status(),
                'response_body' => $response->json(),
            ]);


            if ($response->failed()) {
                Log::error('ApiBrasil CPF Request Failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'cpf' => $cpf
                ]);

                return [
                    'success' => false,
                    'message' => 'Falha ao consultar ApiBrasil.',
                    'error' => $response->json(),
                    'status' => $response->status()
                ];
            }

            return [
                'success' => true,
                'data' => $response->json()
            ];

        } catch (\Exception $e) {
            Log::error('ApiBrasil CPF Exception', [
                'message' => $e->getMessage(),
                'cpf' => $cpf
            ]);

            return [
                'success' => false,
                'message' => 'Erro interno ao processar consulta CPF.',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Consulta créditos de CNPJ.
     *
     * @param string $cnpj
     * @param string $tipo
     * @param bool $homolog
     * @return array
     */
    public function checkCnpjCredits(string $cnpj, string $tipo = 'quod-restricao-pj', bool $homolog = true): array
    {
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => "Bearer {$this->token}",
                'User-Agent' => 'Laravel/10.0',
            ])->post("{$this->baseUrl}/quod/cnpj/credits", [
                        'tipo' => $tipo,
                        'cnpj' => $cnpj,
                        'homolog' => $homolog,
                    ]);

            Log::info('ApiBrasil CNPJ Request', [
                'endpoint' => "{$this->baseUrl}/quod/cnpj/credits",
                'payload' => compact('tipo', 'cnpj', 'homolog'),
                'response_status' => $response->status(),
                'response_body' => $response->json(),
            ]);

            if ($response->failed()) {
                Log::error('ApiBrasil CNPJ Request Failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'cnpj' => $cnpj
                ]);

                return [
                    'success' => false,
                    'message' => 'Falha ao consultar ApiBrasil.',
                    'error' => $response->json(),
                    'status' => $response->status()
                ];
            }

            return [
                'success' => true,
                'data' => $response->json()
            ];

        } catch (\Exception $e) {
            Log::error('ApiBrasil CNPJ Exception', [
                'message' => $e->getMessage(),
                'cnpj' => $cnpj
            ]);

            return [
                'success' => false,
                'message' => 'Erro interno ao processar consulta CNPJ.',
                'error' => $e->getMessage()
            ];
        }
    }
}
